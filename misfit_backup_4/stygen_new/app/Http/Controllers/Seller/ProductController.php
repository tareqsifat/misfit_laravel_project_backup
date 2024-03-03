<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductCategory;
use App\Models\ProductImages;
use App\Models\ProductRecipient;
use App\Models\StockLedger;
use DateTime;
use Helper;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductOccasion;
use App\Models\ProductShippingCharge;
use App\Models\ProductVariation;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->keyword;
        $companyId = Auth::guard('seller')->user()->company_id;
        if($search != null){
            $products = Product::where('company_id', $companyId)
                ->with('brand')
                ->withSum(['purchase_stock' => function ($q) {
                    $q->where('type', 'purchase');
                }], 'qty')
                ->withSum(['sell_stock' => function ($q) {
                    $q->where('type', 'sell');
                }], 'qty')
                ->where(function ($query) use ($search) {
                    $query->where("product_name", "LIKE", "%{$search}%")
                        ->orWhere("product_sku", "LIKE", "%{$search}%")
                        ->orWhere("regular_price", "LIKE", "%{$search}%")
                        ->orWhere("sales_price", "LIKE", "%{$search}%")
                        ->orWhere("quantity", "LIKE", "%{$search}%")
                        ->orWhere("created_at", "LIKE", "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $products = Product::where('company_id', $companyId)->orderBy('id','desc')->with('brand')
            ->withSum(['purchase_stock' => function ($q) {
                $q->where('type', 'purchase');
            }], 'qty')
            ->withSum(['sell_stock' => function ($q) {
                $q->where('type', 'sell');
            }], 'qty')
            ->paginate(10);
        }
        return response()->json([
            'products' => $products
        ], 200);
    }

    public function productStockUpdate() {
        // dd(request()->all());
        $product_stock = new ProductStock();
        $product_stock->product_id = request()->product_id;
        $product_stock->qty = request()->quantity;
        $product_stock->company_id = Auth::guard('seller')->user()->company_id;
        $product_stock->type = request()->type;
        $product_stock->created_by = Auth::guard('seller')->user()->id;
        $product_stock->save();

        return response()->json([
            'data' => $product_stock,
            'message' => "product stock updated"
        ], 200);
    }

    public function all_products()
    {
        $companyId = Auth::guard('seller')->user()->company_id;

        $products = Product::where('company_id', $companyId)->orderBy('id','desc')->select('id', 'product_name')
        ->withSum(['purchase_stock' => function ($q) {
            $q->where('type', 'purchase');
        }], 'qty')
        ->withSum(['sell_stock' => function ($q) {
            $q->where('type', 'sell');
        }], 'amount')
        ->get();

        return response()->json([
            'products' => $products
        ], 200);
    }

    //Search
    public function searchSellerProduct(Request $request)
    {
        $search = $request->keyword;
        $companyId = Auth::guard('seller')->user()->company_id;

        if($search != null){
            $products = Product::where('company_id', $companyId)
                ->with('brand')
                ->where(function ($query) use ($search) {
                    $query->where("product_name", "LIKE", "%{$search}%")
                        ->orWhere("product_sku", "LIKE", "%{$search}%")
                        ->orWhere("regular_price", "LIKE", "%{$search}%")
                        ->orWhere("sales_price", "LIKE", "%{$search}%")
                        ->orWhere("quantity", "LIKE", "%{$search}%")
                        ->orWhere("created_at", "LIKE", "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
            return response()->json([
                'products' => $products
            ], 200);
        }else{
            return $this->index($request);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $color              = json_decode($request->color);
        $size               = json_decode($request->size);
        $weight             = json_decode($request->weight);
        $attribute_stock    = json_decode($request->attribute_stock);


        if (array_filter($attribute_stock) == []) {
            $attribute_count    = 0;
        }else {
            $attribute_count    = count($attribute_stock);
        }

        if($attribute_count > 0) {
            $request->validate([
                'category_id'       => 'required',
                'product_name'      => 'required',
                'product_sku'       => 'required | unique:products',
                'regular_price'     => 'required',
                //'images'            => 'required',
                'featured_image'    => 'required',
            ],
            [
                'category_id.required' => 'The category field is required.'
            ]);
        } else {
            $request->validate([
                'category_id'       => 'required',
                'product_name'      => 'required',
                'product_sku'       => 'required | unique:products',
                'regular_price'     => 'required',
                'quantity'          => 'required',
                //'images'            => 'required',
                'featured_image'    => 'required',
            ],
            [
                'category_id.required' => 'The category field is required.'
            ]);
        }

        $companyId              = Auth::guard('seller')->user()->company_id;
        $userId                 = Auth::guard('seller')->user()->id;

        $model                  = DB::table('stock_ledgers');
        $ledgerType             = 4;
        $invoice_no             = Helper::autoInvoiceNoGenereate($model, $ledgerType);
        $current_date           = date('d/m/Y');
        $invoice_date           = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');

         // FETURED IMAGE SECTION
         if($request->hasFile('featured_image')){
            $featured_image = $request->file('featured_image');
            $upload_path = public_path('assets/uploads/product');
            $featured_image_name = time().'-'.$featured_image->getClientOriginalName();
            $featured_image->move($upload_path, $featured_image_name);
        }

        if($request->sales_price == '' || $request->sales_price == 0 || $request->sales_price == NULL){
            $salesPrice = NULL;
        }else{
            $salesPrice = $request->sales_price;
        }

        $existing_sku = Product::where('company_id', $companyId)->where('status', 1)->where('product_sku', $request->product_sku)->first();

        if(isset($existing_sku)){
            $product_sku = $request->product_sku.'-'.mt_rand(10,99);
        }else{
            $product_sku = $request->product_sku;
        }

        $existing_slug = Product::where('company_id', $companyId)->where('status', 1)->where('product_name', $request->product_name)->first();

        if(isset($existing_slug)){
            $product_name = $request->product_name.'-'.mt_rand(10,99);
        }else{
            $product_name = $request->product_name;
        }

        $product = Product::create([
           'company_id'             => $companyId,
           'category_id'            => json_decode($request->category_id),
           'brand_id'               => $request->brand_id,
           'product_name'           => $request->product_name,
           'pro_slug'               => Str::slug($product_name),
           'product_sku'            => $product_sku,
           'short_description'      => $request->short_description,
           'long_description'       => $request->long_description,
           'regular_price'          => $request->regular_price,
           'sales_price'            => $salesPrice,
           'quantity'               => $request->quantity,
           'youtube_link'           => (!empty($request->youtube_link))?$request->youtube_link:NULL,
           'vat'                    => (!empty($request->vat))?$request->vat:NULL,
           'shipping_charge_id'     => (!empty($request->shipping_charge_id))?json_decode($request->shipping_charge_id):NULL,
           'occasion_id'            => (!empty($request->occasion_id))?json_decode($request->occasion_id):NULL,
           'recipient_id'           => (!empty($request->recipient_id))?json_decode($request->recipient_id):NULL,
           'featured_image'         => $featured_image_name,
           'discount_status'        => (!empty($request->sales_price))? 1: 0,
           //'status'                 => ($request->status == 'true'?1:0),
           'status'                 => 0,
           'created_by'             => $userId,
        ]);

        if($product){
            // IMAGE SECTION
            if($request->hasFile('images')){
                $images = $request->file('images');
                $upload_path = public_path('assets/uploads/product');
                foreach ($images as $image){
                    $name = time().'-'.$image->getClientOriginalName();
                    $image->move($upload_path, $name);
                    ProductImages::create([
                       'company_id'     => $product->company_id,
                       'product_id'     => $product->id,
                       'image'          => $name,
                       'status'         => 1,
                    ]);
                }
            }

            // CATEGORY SECTION
            foreach (json_decode($request->category_id) as $category_id) {
                $product_category = ProductCategory::create([
                    'company_id'        => $product->company_id,
                    'product_id'        => $product->id,
                    'category_id'       => $category_id,
                    'status'            => 1,
                ]);
            }

            // SHIPPING CHARGE SECTION
            if(!empty($request->shipping_charge_id)){
                foreach (json_decode($request->shipping_charge_id) as $shipping_charge) {
                    $shipping_charge = ProductShippingCharge::create([
                        'product_id'            => $product->id,
                        'shipping_charge_id'    => $shipping_charge,
                        'status'                => 1,
                    ]);
                }
            }

            // OCCASION GIFT SECTION
            if(!empty($request->occasion_id)){
                foreach (json_decode($request->occasion_id) as $occasionId) {
                    $occasion = ProductOccasion::create([
                        'product_id'            => $product->id,
                        'occasion_id'           => $occasionId,
                        'status'                => 1,
                    ]);
                }
            }

            // RECIPIENT GIFT SECTION
            if(!empty($request->recipient_id)){
                foreach (json_decode($request->recipient_id) as $recipientId) {
                    $recipient = ProductRecipient::create([
                        'product_id'            => $product->id,
                        'recipient_id'          => $recipientId,
                        'status'                => 1,
                    ]);
                }
            }

            // ATTRIBUTE SECTION
            if($attribute_count > 0) {
                foreach ($attribute_stock as $key => $stock) {
                    $colorInfo = AttributeValue::where('attribute_value', $color[$key])->select('attribute_code')->first();
                    if(isset($colorInfo)){
                        $color_code = $colorInfo->attribute_code;
                    }else{
                        $color_code = NULL;
                    }

                    $product_variation = ProductVariation::create([
                        'product_id'        => $product->id,
                        'color'             => $color[$key],
                        'color_code'        => $color_code,
                        'size'              => $size[$key],
                        'weight'            => $weight[$key],
                        'attribute_stock'   => $attribute_stock[$key],
                        'status'            => 1,
                        'created_by'        => $userId,
                    ]);
                    // STOCK LEDGER SECTION
                    $stock_ledger = StockLedger::create([
                        'company_id'  => $product->company_id,
                        'invoice_no'  => $invoice_no,
                        'invoice_date'=> $invoice_date,
                        'product_id'  => $product->id,
                        'variation_id'=> $product_variation->id,
                        'stock_in'    => $attribute_stock[$key],
                        'stock_out'   => 0,
                        'ledger_type' => 4,
                        'status'      => 1,
                        'created_by'  => $userId
                    ]);
                }
            } else {
                // STOCK LEDGER SECTION
                $stock_ledger = StockLedger::create([
                    'company_id'  => $product->company_id,
                    'invoice_no'  => $invoice_no,
                    'invoice_date'=> $invoice_date,
                    'product_id'  => $product->id,
                    'variation_id'=> NULL,
                    'stock_in'    => $product->quantity,
                    'stock_out'   => 0,
                    'ledger_type' => 4,
                    'status'      => 1,
                    'created_by'  => $userId
                ]);
            }
            return 'success';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('product_images','product_categories','product_attributes', 'product_variations')
        ->withSum(['purchase_stock' => function ($q) {
            $q->where('type', 'purchase');
        }], 'qty')
        ->withSum(['sell_stock' => function ($q) {
            $q->where('type', 'sell');
        }], 'qty')
        ->find($id);
        return response()->json([
            'product' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $color              = json_decode($request->color);
        $size               = json_decode($request->size);
        $weight             = json_decode($request->weight);
        $attribute_stock    = json_decode($request->attribute_stock);

        if (array_filter($attribute_stock) == []) {
            $attribute_count    = 0;
        }else {
            $attribute_count    = count($attribute_stock);
        }

        if($attribute_count > 0) {
            $request->validate([
                'category_id'       => 'required',
                'product_name'      => 'required',
                'product_sku'       => 'required',
                'regular_price'     => 'required',
                // 'images'            => 'required',
            ],
            [
                'category_id.required' => 'The category field is required.'
            ]);
        } else {
            $request->validate([
                'category_id'       => 'required',
                'product_name'      => 'required',
                'product_sku'       => 'required',
                'regular_price'     => 'required',
                'quantity'          => 'required',
                // 'images'            => 'required',
            ],
            [
                'category_id.required' => 'The category field is required.'
            ]);
        }

        $companyId              = Auth::guard('seller')->user()->company_id;
        $userId                 = Auth::guard('seller')->user()->id;

        $model                  = DB::table('stock_ledgers');
        $ledgerType             = 4;
        $invoice_no             = Helper::autoInvoiceNoGenereate($model, $ledgerType);
        $current_date           = date('d/m/Y');
        $invoice_date           = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');


        $product = Product::where('id', $id)->first();

        // FETURED IMAGE SECTION
        if($request->hasFile('featured_image')){
            $featured_image = $request->file('featured_image');
            $upload_path = public_path('assets/uploads/product');
            $featured_image_name = time().'-'.$featured_image->getClientOriginalName();
            $featured_image->move($upload_path, $featured_image_name);

            $existImage = public_path('assets/uploads/product/'.$product->featured_image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
        }else{
            $featured_image_name = $product->featured_image;
        }

        if($request->sales_price == '' || $request->sales_price == 0 || $request->sales_price == NULL){
            $salesPrice = NULL;
        }else{
            $salesPrice = $request->sales_price;
        }

        $existing_sku = Product::where('company_id', $companyId)->where('status', 1)->where('product_sku', $request->product_sku)->first();

        if(isset($existing_sku)){
            $product_sku = $existing_sku->product_sku;
        }else{
            $product_sku = $request->product_sku;
        }

        $existing_slug = Product::where('company_id', $companyId)->where('status', 1)->where('product_name', $request->product_name)->first();

        if(isset($existing_slug)){
            $product_slug = $existing_slug->pro_slug;
        }else{
            $product_slug = Str::slug($request->product_name);
        }

        $product->update([
           'company_id'             => $companyId,
           'category_id'            => json_decode($request->category_id),
           'brand_id'               => $request->brand_id,
           'product_name'           => $request->product_name,
           'pro_slug'               => $product_slug,
           'product_sku'            => $product_sku,
           'short_description'      => ($request->short_description != 'null')?$request->short_description:NULL,
           'long_description'       => ($request->long_description != 'null')?$request->long_description:NULL,
           'regular_price'          => $request->regular_price,
           'sales_price'            => $salesPrice,
           'quantity'               => $request->quantity,
           'youtube_link'           => ($request->youtube_link != 'null')?$request->youtube_link:NULL,
           'vat'                    => (!empty($request->vat))?$request->vat:NULL,
           'shipping_charge_id'     => (!empty($request->shipping_charge_id))?json_decode($request->shipping_charge_id):NULL,
           'occasion_id'            => (!empty($request->occasion_id))?json_decode($request->occasion_id):NULL,
           'recipient_id'           => (!empty($request->recipient_id))?json_decode($request->recipient_id):NULL,
           'featured_image'         => $featured_image_name,
           'discount_status'        => (!empty($request->sales_price))? 1: 0,
           'status'                 => ($request->status == 'true'?1:0),
           'created_by'             => $userId,
        ]);

        if($product){
            // PREVIOUS PRODUCT IMAGES
            $prev_image_ids = json_decode($request->prev_image_ids);
            if(count($prev_image_ids) > 0) {
                $product_images = ProductImages::where('product_id', $id)->get()->pluck('id');
                ProductImages::whereNotIn('id', $prev_image_ids)->where('product_id', $id)->update(['status' => 0]);
                ProductImages::whereNotIn('id', $prev_image_ids)->where('product_id', $id)->delete();
            }

            // IMAGE SECTION
            if($request->hasFile('images')){
                $images = $request->file('images');
                $upload_path = public_path('assets/uploads/product');
                foreach ($images as $image){
                    $name = time().'-'.$image->getClientOriginalName();
                    $image->move($upload_path, $name);
                    ProductImages::create([
                       'company_id'     => $product->company_id,
                       'product_id'     => $product->id,
                       'image'          => $name,
                       'status'         => 1,
                    ]);
                }
            }

            // CATEGORY SECTION
            $categoryIds = ProductCategory::where('product_id', $product->id)->get()->pluck('id');
            ProductCategory::whereIn('id', $categoryIds)->forceDelete();

            foreach (json_decode($request->category_id) as $category_id) {
                $product_category = ProductCategory::create([
                    'company_id'        => $product->company_id,
                    'product_id'        => $product->id,
                    'category_id'       => $category_id,
                    'status'            => 1,
                ]);
            }

            // SHIPPING CHARGE SECTION
            if($request->shipping_charge_id != 'null'){
                $shippingChargeIds = ProductShippingCharge::where('product_id', $product->id)->get()->pluck('id');
                ProductShippingCharge::whereIn('id', $shippingChargeIds)->forceDelete();

                foreach (json_decode($request->shipping_charge_id) as $shipping_charge) {
                    $shipping_charge = ProductShippingCharge::create([
                        'product_id'                => $product->id,
                        'shipping_charge_id'        => $shipping_charge,
                        'status'                    => 1,
                    ]);
                }
            }


            // OCCASION GIFT SECTION
            if($request->occasion_id != 'null'){
                $occasion_Ids = ProductOccasion::where('product_id', $product->id)->get()->pluck('id');
                ProductOccasion::whereIn('id', $occasion_Ids)->forceDelete();

                foreach (json_decode($request->occasion_id) as $occasionId) {
                    $occasion = ProductOccasion::create([
                        'product_id'                => $product->id,
                        'occasion_id'               => $occasionId,
                        'status'                    => 1,
                    ]);
                }
            }

            // RECIPIENT GIFT SECTION
            if($request->recipient_id != 'null'){
                $recipient_Ids = ProductRecipient::where('product_id', $product->id)->get()->pluck('id');
                ProductRecipient::whereIn('id', $recipient_Ids)->forceDelete();

                foreach (json_decode($request->recipient_id) as $recipientId) {
                    $recipient = ProductRecipient::create([
                        'product_id'                => $product->id,
                        'recipient_id'              => $recipientId,
                        'status'                    => 1,
                    ]);
                }
            }

            // ATTRIBUTE SECTION
            $prev_attribute_ids = ProductVariation::where('product_id', $id)->get()->pluck('id');
            ProductVariation::whereIn('id', $prev_attribute_ids)->forceDelete();

            if($attribute_count > 0) {
                foreach ($attribute_stock as $key => $stock) {
                    $colorInfo = AttributeValue::where('attribute_value', $color[$key])->select('attribute_code')->first();
                    if(isset($colorInfo)){
                        $color_code = $colorInfo->attribute_code;
                    }else{
                        $color_code = NULL;
                    }

                    $product_variation = ProductVariation::create([
                        'product_id'        => $product->id,
                        'color'             => $color[$key],
                        'color_code'        => $color_code,
                        'size'              => $size[$key],
                        'weight'            => $weight[$key],
                        'attribute_stock'   => $attribute_stock[$key],
                        'status'            => 1,
                        'created_by'        => $userId,
                    ]);
                    // STOCK LEDGER SECTION
                    $stock_ledger = StockLedger::create([
                        'company_id'  => $product->company_id,
                        'invoice_no'  => $invoice_no,
                        'invoice_date'=> $invoice_date,
                        'product_id'  => $product->id,
                        'variation_id'=> $product_variation->id,
                        'stock_in'    => $attribute_stock[$key],
                        'stock_out'   => 0,
                        'ledger_type' => 4,
                        'status'      => 1,
                        'created_by'  => $userId
                    ]);
                }
            } else {
                // STOCK LEDGER SECTION
                $stock_ledger = StockLedger::create([
                    'company_id'  => $product->company_id,
                    'invoice_no'  => $invoice_no,
                    'invoice_date'=> $invoice_date,
                    'product_id'  => $product->id,
                    'variation_id'=> NULL,
                    'stock_in'    => $product->quantity,
                    'stock_out'   => 0,
                    'ledger_type' => 4,
                    'status'      => 1,
                    'created_by'  => $userId
                ]);
            }
        }

    }

    public function duplicate(Request $request, $id){
        $color              = json_decode($request->color);
        $size               = json_decode($request->size);
        $weight             = json_decode($request->weight);
        $attribute_stock    = json_decode($request->attribute_stock);


        if (array_filter($attribute_stock) == []) {
            $attribute_count    = 0;
        }else {
            $attribute_count    = count($attribute_stock);
        }

        if($attribute_count > 0) {
            $request->validate([
                'category_id'       => 'required',
                'product_name'      => 'required',
                'product_sku'       => 'required | unique:products',
                'regular_price'     => 'required',
                //'images'            => 'required',
                //'featured_image'    => 'required',
            ],
            [
                'category_id.required' => 'The category field is required.'
            ]);
        } else {
            $request->validate([
                'category_id'       => 'required',
                'product_name'      => 'required',
                'product_sku'       => 'required | unique:products',
                'regular_price'     => 'required',
                'quantity'          => 'required',
                //'images'            => 'required',
                //'featured_image'    => 'required',
            ],
            [
                'category_id.required' => 'The category field is required.'
            ]);
        }

        $companyId              = Auth::guard('seller')->user()->company_id;
        $userId                 = Auth::guard('seller')->user()->id;

        $model                  = DB::table('stock_ledgers');
        $ledgerType             = 4;
        $invoice_no             = Helper::autoInvoiceNoGenereate($model, $ledgerType);
        $current_date           = date('d/m/Y');
        $invoice_date           = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');

        $product = Product::where('id', $id)->first();

        // FETURED IMAGE SECTION
        if($request->hasFile('featured_image')){
            $featured_image = $request->file('featured_image');
            $upload_path = public_path('assets/uploads/product');
            $featured_image_name = time().'-'.$featured_image->getClientOriginalName();
            $featured_image->move($upload_path, $featured_image_name);
        }else{
            $featured_image_name = $product->featured_image;
        }

        if($request->sales_price == '' || $request->sales_price == 0 || $request->sales_price == NULL){
            $salesPrice = NULL;
        }else{
            $salesPrice = $request->sales_price;
        }

        $existing_sku = Product::where('company_id', $companyId)->where('status', 1)->where('product_sku', $request->product_sku)->first();

        if(isset($existing_sku)){
            $product_sku = $request->product_sku.'-'.mt_rand(10,99);
        }else{
            $product_sku = $request->product_sku;
        }

        $existing_slug = Product::where('company_id', $companyId)->where('status', 1)->where('product_name', $request->product_name)->first();

        if(isset($existing_slug)){
            $product_name = $request->product_name.'-'.mt_rand(10,99);
        }else{
            $product_name = $request->product_name;
        }

        $product = Product::create([
           'company_id'             => $companyId,
           'category_id'            => json_decode($request->category_id),
           'brand_id'               => $request->brand_id,
           'product_name'           => $request->product_name,
           'pro_slug'               => Str::slug($product_name),
           'product_sku'            => $product_sku,
           'short_description'      => ($request->short_description != 'null')?$request->short_description:NULL,
           'long_description'       => ($request->long_description != 'null')?$request->long_description:NULL,
           'regular_price'          => $request->regular_price,
           'sales_price'            => $salesPrice,
           'quantity'               => $request->quantity,
           'youtube_link'           => (!empty($request->youtube_link))?$request->youtube_link:NULL,
           'vat'                    => (!empty($request->vat))?$request->vat:NULL,
           'shipping_charge_id'     => (!empty($request->shipping_charge_id))?json_decode($request->shipping_charge_id):NULL,
           'occasion_id'            => (!empty($request->occasion_id))?json_decode($request->occasion_id):NULL,
           'recipient_id'           => (!empty($request->recipient_id))?json_decode($request->recipient_id):NULL,
           'featured_image'         => $featured_image_name,
           'discount_status'        => (!empty($request->sales_price))? 1: 0,
           'status'                 => ($request->status == 'true'?1:0),
           'created_by'             => $userId,
        ]);

        if($product){
            // IMAGE SECTION
            if($request->hasFile('images')){
                $images = $request->file('images');
                $upload_path = public_path('assets/uploads/product');
                foreach ($images as $image){
                    $name = time().'-'.$image->getClientOriginalName();
                    $image->move($upload_path, $name);
                    ProductImages::create([
                       'company_id'     => $product->company_id,
                       'product_id'     => $product->id,
                       'image'          => $name,
                       'status'         => 1,
                    ]);
                }
            }else{
                $prev_image_ids = json_decode($request->prev_image_ids);
                if(count($prev_image_ids) > 0) {
                    $product_images = ProductImages::whereIn('id', $prev_image_ids)->where('product_id', $id)->where('status', 1)->get();
                    foreach($product_images as $image){
                        ProductImages::create([
                            'company_id'     => $product->company_id,
                            'product_id'     => $product->id,
                            'image'          => $image->image,
                            'status'         => 1,
                         ]);
                    }
                }
            }


            // CATEGORY SECTION
            foreach (json_decode($request->category_id) as $category_id) {
                $product_category = ProductCategory::create([
                    'company_id'        => $product->company_id,
                    'product_id'        => $product->id,
                    'category_id'       => $category_id,
                    'status'            => 1,
                ]);
            }

            // SHIPPING CHARGE SECTION
            if(!empty($request->shipping_charge_id)){
                foreach (json_decode($request->shipping_charge_id) as $shipping_charge) {
                    $shipping_charge = ProductShippingCharge::create([
                        'product_id'            => $product->id,
                        'shipping_charge_id'    => $shipping_charge,
                        'status'                => 1,
                    ]);
                }
            }

            // OCCASION GIFT SECTION
            if(!empty($request->occasion_id)){
                foreach (json_decode($request->occasion_id) as $occasionId) {
                    $occasion = ProductOccasion::create([
                        'product_id'            => $product->id,
                        'occasion_id'           => $occasionId,
                        'status'                => 1,
                    ]);
                }
            }

            // RECIPIENT GIFT SECTION
            if(!empty($request->recipient_id)){
                foreach (json_decode($request->recipient_id) as $recipientId) {
                    $recipient = ProductRecipient::create([
                        'product_id'            => $product->id,
                        'recipient_id'          => $recipientId,
                        'status'                => 1,
                    ]);
                }
            }

            // ATTRIBUTE SECTION
            if($attribute_count > 0) {
                foreach ($attribute_stock as $key => $stock) {
                    $colorInfo = AttributeValue::where('attribute_value', $color[$key])->select('attribute_code')->first();
                    if(isset($colorInfo)){
                        $color_code = $colorInfo->attribute_code;
                    }else{
                        $color_code = NULL;
                    }

                    $product_variation = ProductVariation::create([
                        'product_id'        => $product->id,
                        'color'             => $color[$key],
                        'color_code'        => $color_code,
                        'size'              => $size[$key],
                        'weight'            => $weight[$key],
                        'attribute_stock'   => $attribute_stock[$key],
                        'status'            => 1,
                        'created_by'        => $userId,
                    ]);
                    // STOCK LEDGER SECTION
                    $stock_ledger = StockLedger::create([
                        'company_id'  => $product->company_id,
                        'invoice_no'  => $invoice_no,
                        'invoice_date'=> $invoice_date,
                        'product_id'  => $product->id,
                        'variation_id'=> $product_variation->id,
                        'stock_in'    => $attribute_stock[$key],
                        'stock_out'   => 0,
                        'ledger_type' => 4,
                        'status'      => 1,
                        'created_by'  => $userId
                    ]);
                }
            } else {
                // STOCK LEDGER SECTION
                $stock_ledger = StockLedger::create([
                    'company_id'  => $product->company_id,
                    'invoice_no'  => $invoice_no,
                    'invoice_date'=> $invoice_date,
                    'product_id'  => $product->id,
                    'variation_id'=> NULL,
                    'stock_in'    => $product->quantity,
                    'stock_out'   => 0,
                    'ledger_type' => 4,
                    'status'      => 1,
                    'created_by'  => $userId
                ]);
            }
            return 'success';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $userId = Auth::guard('seller')->user()->id;
        $product = Product::find($id)->update(['deleted_by' => $userId, 'status' => 0]);
        Product::find($id)->delete();
        return $this->index($request);
    }

    //Upload Product
    public function uploadProduct(Request $request){
        $request->validate([
            'product_excel' => 'required|mimes:csv,xlsx',
        ]);

        Excel::import(new ProductImport,request()->file('product_excel'));

        return response()->json('success');
    }

    //Multiple Product Delete
    public function multipleProductDelete(Request $request){
        $userId = Auth::guard('seller')->user()->id;
        foreach ($request->all()  as $product){
            Product::find($product['id'])->update(['deleted_by' => $userId, 'status' => 0]);
            Product::find($product['id'])->delete();
        }
        return 'Success';
    }

    // GET ALL ATTRIBUTES
    public function getProAttribute(Request $request) {
        $attribute_value = 1;

        $attribute_values  = $request['attribute_name'];
        $companyId = Auth::guard('seller')->user()->company_id;
        $attr = [];
        $attr_val = [];
        foreach ($attribute_values as $attributeValue){
            $attributes = AttributeValue::join('attributes','attributes.id','=','attribute_values.attribute_id')
                ->select('attributes.attribute_name')
                ->where('attribute_values.status', 1)
                ->where('attribute_values.attribute_value', $attributeValue)
                ->where('attribute_values.company_id', $companyId)
                ->first()->attribute_name;

            if(!in_array($attributes, $attr, true)){
                array_push($attr, $attributes);
                array_push($attr_val, $attributeValue);
            }
        }

        $attributeValues[] = $attr_val;
        $attribute_set = array();
        foreach($attributeValues as $attributeValue) {
            $attribute_set = array_combine($attr, $attributeValue);
        }


        function variations( $array ){
            if( empty( $array ) ) return [];

            function traverse( $array, $parent_ind ){
                $r = [];
                $pr = '';
                if( !is_numeric($parent_ind) )
                    $pr = $parent_ind . '-';
                foreach( $array as $ind=>$el ) {
                    if ( is_array( $el ) ) {
                        $r = array_merge( $r, traverse( $el, $pr . ( is_numeric( $ind ) ? '' : $ind ) ) );
                    }else
                        if ( is_numeric( $ind ) )
                            $r[] = $pr . $el;
                        else
                            $r[] = $pr . $ind . '-' . $el;
                }
                return $r;
            }

            //1. Go through entire array and transform elements that are arrays into elements, collect keys
            $keys = [];$size = 1;
            foreach( $array as $key=>$elems ) {
                if ( is_array( $elems ) ) {
                    $rr = [];
                    foreach ( $elems as $ind=>$elem ) {
                        if ( is_array( $elem ) )
                            $rr = array_merge( $rr, traverse( $elem, $ind ) );
                        else $rr[] = $elem;
                    }
                    $array[ $key ] = $rr;
                    $size *= count( $rr );
                }
                $keys[] = $key;
            }

            //2. Go through all new elems and make variations
            $rez = [];
            for( $i = 0; $i < $size; $i++ ) {
                $rez[ $i ] = array();
                foreach( $array as $key => $value ){
                    $current = current( $array[ $key ] );
                    $rez[ $i ][ $key ] = $current;
                }
                foreach( $keys as $key )
                    if( !next( $array[ $key ] ) ) reset( $array[ $key ] );
                    else break;
            }
            return $rez;
        }

        $data['attributeLists'] = $attributeLists = variations($attribute_set);
        $attrLists = [];
        foreach($attributeLists as $key => $attributeList) {
            foreach ($attributeList as $KEY => $attribute_list) {
                $main_key = $KEY.$key.":"."''".",";
                array_push($attrLists, $main_key);
            }
        }
        $data['attrLists'] = json_encode($attrLists);
        $data['all_attributes'] = Attribute::join('attribute_values','attribute_values.attribute_id','=','attributes.id')->where('attributes.status', 1)->where('attributes.company_id', $companyId)->get();
        $data['type']           = $attribute_value;
        return $data;
    }

    //Get Product Attributes
    public function getProductAttributes(){
        $company_id = Auth::guard('seller')->user()->company_id;
        $colors = AttributeValue::join('attributes', 'attributes.id', '=', 'attribute_values.attribute_id')
                ->where('attributes.attribute_name', 'Color')
                ->where('attributes.status', 1)
                ->where('attribute_values.company_id', $company_id)
                ->select('attribute_values.*')
                ->groupBy('attribute_values.attribute_value')
                ->get();

        $sizes = AttributeValue::join('attributes', 'attributes.id', '=', 'attribute_values.attribute_id')
            ->where('attributes.attribute_name', 'Size')
            ->where('attributes.status', 1)
            ->where('attribute_values.company_id', $company_id)
            ->select('attribute_values.*')
            ->groupBy('attribute_values.attribute_value')
            ->get();

        $weights = AttributeValue::join('attributes', 'attributes.id', '=', 'attribute_values.attribute_id')
            ->where('attributes.attribute_name', 'Weight')
            ->where('attributes.status', 1)
            ->where('attribute_values.company_id', $company_id)
            ->select('attribute_values.*')
            ->groupBy('attribute_values.attribute_value')
            ->get();
        return response()->json([
            'colors' => $colors,
            'sizes' => $sizes,
            'weights' => $weights,
        ], 200);
    }

    //Shipping Charge
    public function shippingCharge()
    {
        $shippings = ShippingCharge::where('status', 1)->get();
        return response()->json([
            'shippings' => $shippings
        ], 200);
    }

    //Product Status Update
    public function productStatusChange(Request $request)
    {
        $status     = $request->status;
        $product_id = $request->product_id;
        Product::where('id', $product_id)->update(['status' => $status]);
        return response()->json('Success');
    }
}




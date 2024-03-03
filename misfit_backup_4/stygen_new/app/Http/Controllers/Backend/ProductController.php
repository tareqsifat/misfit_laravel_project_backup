<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Addon_product;
use App\Models\ProductCategory;
use App\Models\ProductImages;
use App\Models\ProductShippingCharge;
use App\Models\ProductVariation;
use DateTime;
use Helper;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOccasion;
use App\Models\ProductRecipient;
use App\Models\ShippingCharge;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Seller;
use App\Models\StockLedger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        if($search != null){
            $products = Product::with('brand')
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
            if(!empty($request->stock)) {
                $stock = $request->stock;

                $products = Product::get();
                $stock_products = array();
                $stock_out_products = array();
                foreach ($products as $product) {
                    $stockIn = StockLedger::where('product_id', $product->id)->get()->pluck('stock_in')->toArray();
                    $stockOut = StockLedger::where('product_id', $product->id)->get()->pluck('stock_out')->toArray();

                    $stockQty = array_sum($stockIn)-array_sum($stockOut);
                    if ($stockQty>0) {
                        $stock_products[]= $product->id;
                    }
                    if($stockQty <= 0) {
                        $stock_out_products[] = $product->id;
                    }
                }

                if($stock == 'in_stock') {
                    if(!empty($request->category_id)) {
                        $category_id = $request->category_id;
                        $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                        if(count($category_ids) > 0) {
                            $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                        } else {
                            $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_products)->get()->pluck('product_id');
                        }

                        if(!empty($request->seller_id)) {
                            $seller_id = $request->seller_id;
                            $company_id = Seller::where('id', $seller_id)->first()->company_id;
                            $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_products)
                            ->withSum(['purchase_stock' => function ($q) {
                                $q->where('type', 'purchase');
                            }], 'qty')
                            ->withSum(['sell_stock' => function ($q) {
                                $q->where('type', 'sell');
                            }], 'qty')
                            ->with('brand')->paginate(10);
                        } else {
                            $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_products)
                            ->withSum(['purchase_stock' => function ($q) {
                                $q->where('type', 'purchase');
                            }], 'qty')
                            ->withSum(['sell_stock' => function ($q) {
                                $q->where('type', 'sell');
                            }], 'qty')
                            ->with('brand')->paginate(10);
                        }
                    } else {
                        if(!empty($request->seller_id)) {
                            $seller_id = $request->seller_id;
                            $company_id = Seller::where('id', $seller_id)->first()->company_id;
                            $products = Product::where('company_id', $company_id)->whereIn('id', $stock_products)->with('brand')
                            ->withSum(['purchase_stock' => function ($q) {
                                $q->where('type', 'purchase');
                            }], 'qty')
                            ->withSum(['sell_stock' => function ($q) {
                                $q->where('type', 'sell');
                            }], 'qty')
                            ->paginate(10);
                        } else {
                            $products = Product::whereIn('id', $stock_products)->with('brand')
                            ->withSum(['purchase_stock' => function ($q) {
                                $q->where('type', 'purchase');
                            }], 'qty')
                            ->withSum(['sell_stock' => function ($q) {
                                $q->where('type', 'sell');
                            }], 'qty')
                            ->paginate(10);
                        }
                    }


                } elseif($stock == 'out_of_stock') {
                    if(!empty($request->category_id)) {
                        $category_id = $request->category_id;
                        $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                        if(count($category_ids) > 0) {
                            $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_out_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                        } else {
                            $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_out_products)->get()->pluck('product_id');
                        }

                        if(!empty($request->seller_id)) {
                            $seller_id = $request->seller_id;
                            $company_id = Seller::where('id', $seller_id)->first()->company_id;
                            $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')
                            ->withSum(['purchase_stock' => function ($q) {
                                $q->where('type', 'purchase');
                            }], 'qty')
                            ->withSum(['sell_stock' => function ($q) {
                                $q->where('type', 'sell');
                            }], 'qty')
                            ->paginate(10);
                        } else {
                            $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_out_products)
                            ->withSum(['purchase_stock' => function ($q) {
                                $q->where('type', 'purchase');
                            }], 'qty')
                            ->withSum(['sell_stock' => function ($q) {
                                $q->where('type', 'sell');
                            }], 'qty')
                            ->with('brand')->paginate(10);
                        }
                    } else {
                        if(!empty($request->seller_id)) {
                            $seller_id = $request->seller_id;
                            $company_id = Seller::where('id', $seller_id)->first()->company_id;
                            $products = Product::where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')->paginate(10);

                        } else {
                            $products = Product::whereIn('id', $stock_out_products)->with('brand')->paginate(10);
                        }
                    }
                }
            } else {
                // Category
                if(!empty($request->category_id)) {
                    $category_id = $request->category_id;
                    $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                    if(count($category_ids) > 0) {
                        $product_ids = ProductCategory::whereIn('category_id', $category_ids)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                    } else {
                        $product_ids = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
                    }
                    // When Category & Seller Exist
                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)
                        ->withSum(['purchase_stock' => function ($q) {
                            $q->where('type', 'purchase');
                        }], 'qty')
                        ->withSum(['sell_stock' => function ($q) {
                            $q->where('type', 'sell');
                        }], 'qty')
                        ->with('brand')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $product_ids)->with('brand')
                        ->withSum(['purchase_stock' => function ($q) {
                            $q->where('type', 'purchase');
                        }], 'qty')
                        ->withSum(['sell_stock' => function ($q) {
                            $q->where('type', 'sell');
                        }], 'qty')
                        ->paginate(10);
                    }
                }
                elseif(!empty($request->seller_id)) {
                    $seller_id = $request->seller_id;
                    $company_id = Seller::where('id', $seller_id)->first()->company_id;
                    $products = Product::where('company_id', $company_id)->with('brand')
                    ->withSum(['purchase_stock' => function ($q) {
                        $q->where('type', 'purchase');
                    }], 'qty')
                    ->withSum(['sell_stock' => function ($q) {
                        $q->where('type', 'sell');
                    }], 'qty')->paginate(10);
                }
                else {
                    $products = Product::orderBy('id','desc')->with('brand')
                    ->withSum(['purchase_stock' => function ($q) {
                        $q->where('type', 'purchase');
                    }], 'qty')
                    ->withSum(['sell_stock' => function ($q) {
                        $q->where('type', 'sell');
                    }], 'qty')
                    ->paginate(10);
                }
            }

        }
        return response()->json([
            'products' => $products
        ], 200);
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
        //
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
        $product = Product::with('product_images','product_categories','product_attributes', 'product_variations')->find($id);
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

        $product = Product::where('id', $id)->first();

        $companyId              = $product->company_id;
        $userId                 = $product->created_by;

        $model                  = DB::table('stock_ledgers');
        $ledgerType             = 4;
        $invoice_no             = Helper::autoAdminInvoiceNoGenereate($model, $ledgerType, $userId);
        $current_date           = date('d/m/Y');
        $invoice_date           = DateTime::createFromFormat('d/m/Y', $current_date)->format('Y-m-d');


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
            'meta_title'             => (!empty($request->meta_title))?$request->meta_title:NULL,
            'meta_description'       => (!empty($request->meta_description))?$request->meta_description:NULL,
            'status'                 => ($request->status == 'true'?1:0),
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

//    public function update(Request $request, $id)
//    {
//        $request->validate([
//            'category_id'       => 'required',
//            'product_name'      => 'required',
//        ],
//        [
//            'category_id.required' => 'The category field is required.'
//        ]);
//
//        $product = Product::where('id', $id)->first();
//        $product->update([
//           'category_id'            => json_decode($request->category_id),
//           'product_name'           => $request->product_name,
//           'pro_slug'               => Str::slug($request->product_name),
//           'occasion_id'            => (!empty($request->occasion_id))?json_decode($request->occasion_id):NULL,
//           'recipient_id'           => (!empty($request->recipient_id))?json_decode($request->recipient_id):NULL,
//           'meta_title'             => (!empty($request->meta_title))?$request->meta_title:NULL,
//           'meta_description'       => (!empty($request->meta_description))?$request->meta_description:NULL,
//           'status'                 => ($request->status == 'true'?1:0),
//        ]);
//
//        if($product){
//            // CATEGORY SECTION
//            $categoryIds = ProductCategory::where('product_id', $product->id)->get()->pluck('id');
//            ProductCategory::whereIn('id', $categoryIds)->forceDelete();
//
//            foreach (json_decode($request->category_id) as $category_id) {
//                $product_category = ProductCategory::create([
//                    'company_id'        => $product->company_id,
//                    'product_id'        => $product->id,
//                    'category_id'       => $category_id,
//                    'status'            => 1,
//                ]);
//            }
//
//            // OCCASION GIFT SECTION
//            if($request->occasion_id != 'null'){
//                $occasion_Ids = ProductOccasion::where('product_id', $product->id)->get()->pluck('id');
//                ProductOccasion::whereIn('id', $occasion_Ids)->forceDelete();
//
//                foreach (json_decode($request->occasion_id) as $occasionId) {
//                    $occasion = ProductOccasion::create([
//                        'product_id'                => $product->id,
//                        'occasion_id'               => $occasionId,
//                        'status'                    => 1,
//                    ]);
//                }
//            }
//
//            // RECIPIENT GIFT SECTION
//            if($request->recipient_id != 'null'){
//                $recipient_Ids = ProductRecipient::where('product_id', $product->id)->get()->pluck('id');
//                ProductRecipient::whereIn('id', $recipient_Ids)->forceDelete();
//
//                foreach (json_decode($request->recipient_id) as $recipientId) {
//                    $recipient = ProductRecipient::create([
//                        'product_id'                => $product->id,
//                        'recipient_id'              => $recipientId,
//                        'status'                    => 1,
//                    ]);
//                }
//            }
//        }
//    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $userId = Auth::guard('admin')->user()->id;
        $product = Product::find($id)->update(['deleted_by' => $userId, 'status' => 0]);
        Product::find($id)->delete();
        return $this->index($request);
    }

    //Multiple Product Delete
    public function multipleProductDelete(Request $request){
        $userId = Auth::guard('admin')->user()->id;
        foreach ($request->all()  as $product){
            Product::find($product['id'])->update(['deleted_by' => $userId, 'status' => 0]);
            Product::find($product['id'])->delete();
        }
        return 'Success';
    }

    //Addon Product

    //Shipping Charge
    public function shippingCharge()
    {
        $shippings = ShippingCharge::where('status', 1)->get();
        return response()->json([
            'shippings' => $shippings
        ], 200);
    }

    //Get Product Attributes
    public function getProductAttributes(){
        $colors = AttributeValue::join('attributes', 'attributes.id', '=', 'attribute_values.attribute_id')
                ->where('attributes.attribute_name', 'Color')
                ->where('attributes.status', 1)
                ->select('attribute_values.*')
                ->groupBy('attribute_values.attribute_value')
                ->get();

        $sizes = AttributeValue::join('attributes', 'attributes.id', '=', 'attribute_values.attribute_id')
            ->where('attributes.attribute_name', 'Size')
            ->where('attributes.status', 1)
            ->select('attribute_values.*')
            ->groupBy('attribute_values.attribute_value')
            ->get();

        $weights = AttributeValue::join('attributes', 'attributes.id', '=', 'attribute_values.attribute_id')
            ->where('attributes.attribute_name', 'Weight')
            ->where('attributes.status', 1)
            ->select('attribute_values.*')
            ->groupBy('attribute_values.attribute_value')
            ->get();
        return response()->json([
            'colors' => $colors,
            'sizes' => $sizes,
            'weights' => $weights,
        ], 200);
    }

    //Search
    public function searchSellerProduct(Request $request)
    {
        $search = $request->keyword;
        if($search != null){
            $products = Product::with('brand')
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

    public function searchAddonProduct(Request $request) {
        $search = $request->keyword;
        if($search != null){
            $products = Product::with('brand')
                ->where(function ($query) use ($search) {
                    $query->where("product_name", "LIKE", "%{$search}%")
                        ->orWhere("product_sku", "LIKE", "%{$search}%")
                        ->orWhere("regular_price", "LIKE", "%{$search}%")
                        ->orWhere("sales_price", "LIKE", "%{$search}%")
                        ->orWhere("quantity", "LIKE", "%{$search}%")
                        ->orWhere("created_at", "LIKE", "%{$search}%");
                })
                ->orderBy('id', 'desc')->get();
            return response()->json([
                'products' => $products
            ], 200);
        }
    }



    //Seller List for Product Page
    public function getAllSellers(){
        $sellers = Seller::where('status', 1)->orderBy('id','desc')->get();
        return response()->json([
            'sellers' => $sellers
        ], 200);
    }

    // Category Product Filter
    public function catProFilter(Request $request) {
        if(!empty($request->stock)) {
            $stock = $request->stock;

            $products = Product::where('status', 1)->get();
            $stock_products = array();
            $stock_out_products = array();
            foreach ($products as $product) {
                $stockIn = StockLedger::where('product_id', $product->id)->get()->pluck('stock_in')->toArray();
                $stockOut = StockLedger::where('product_id', $product->id)->get()->pluck('stock_out')->toArray();

                $stockQty = array_sum($stockIn)-array_sum($stockOut);
                if ($stockQty>0) {
                    $stock_products[]= $product->id;
                }
                if($stockQty <= 0) {
                    $stock_out_products[] = $product->id;
                }
            }

            if($stock == 'in_stock') {
                if(!empty($request->category_id)) {
                    $category_id = $request->category_id;
                    $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                    if(count($category_ids) > 0) {
                        $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                    } else {
                        $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_products)->get()->pluck('product_id');
                    }

                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                } else {
                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::where('company_id', $company_id)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                }


            } elseif($stock == 'out_of_stock') {
                if(!empty($request->category_id)) {
                    $category_id = $request->category_id;
                    $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                    if(count($category_ids) > 0) {
                        $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_out_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                    } else {
                        $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_out_products)->get()->pluck('product_id');
                    }

                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                } else {
                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                }
            }
        } else {
            if(!empty($request->category_id)) {
                $category_id = $request->category_id;
                $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                if(count($category_ids) > 0) {
                    $product_ids = ProductCategory::whereIn('category_id', $category_ids)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                } else {
                    $product_ids = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
                }

                if(!empty($request->seller_id)) {
                    $seller_id = $request->seller_id;
                    $company_id = Seller::where('id', $seller_id)->first()->company_id;
                    $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::whereIn('id', $product_ids)->with('brand')->orderBy('id','desc')->paginate(10);
                }
            } else {
                if(!empty($request->seller_id)) {
                    $seller_id = $request->seller_id;
                    $company_id = Seller::where('id', $seller_id)->first()->company_id;
                    $products = Product::where('status', 1)->where('company_id', $company_id)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::where('status', 1)->with('brand')->orderBy('id','desc')->paginate(10);
                }
            }
        }

        return response()->json([
            'products' => $products
        ], 200);
    }

    public function get_product_addon_ids (Request $request) {
        $product_id = $request->product_id;
        $products = [];
        if(!empty($product_id)) {
            $productIds = ProductCategory::where('product_id', $product_id)->get()->pluck('product_id');
            if(!empty($productIds)){

                $products = Product::where('status', 1)
                    ->whereIn('id', $productIds)
                    ->orderBy('product_view','desc')
                    ->select('id')
                    ->get()
                    ->pluck('id');

            }
        }
        return response()->json([
            'products' => $products
        ], 200);
    }
    // Seller Product Filter
    public function sellerProFilter(Request $request) {
        // if(!empty($request->seller_id)) {
        //     $seller_id = $request->seller_id;
        //     $company_id = Seller::where('id', $seller_id)->first()->company_id;

        //     if(!empty($request->category_id)) {
        //         $category_id = $request->category_id;
        //         $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

        //         if(count($category_ids) > 0) {
        //             $product_ids = ProductCategory::whereIn('category_id', $category_ids)->orWhere('category_id', $category_id)->get()->pluck('product_id');
        //         } else {
        //             $product_ids = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
        //         }
        //         $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->with('brand')->paginate(10);
        //     } else {
        //         $products = Product::where('company_id', $company_id)->where('status', 1)->with('brand')->paginate(10);
        //     }
        // }

        if(!empty($request->stock)) {
            $stock = $request->stock;

            $products = Product::where('status', 1)->get();
            $stock_products = array();
            $stock_out_products = array();
            foreach ($products as $product) {
                $stockIn = StockLedger::where('product_id', $product->id)->get()->pluck('stock_in')->toArray();
                $stockOut = StockLedger::where('product_id', $product->id)->get()->pluck('stock_out')->toArray();

                $stockQty = array_sum($stockIn)-array_sum($stockOut);
                if ($stockQty>0) {
                    $stock_products[]= $product->id;
                }
                if($stockQty <= 0) {
                    $stock_out_products[] = $product->id;
                }
            }

            if($stock == 'in_stock') {
                if(!empty($request->category_id)) {
                    $category_id = $request->category_id;
                    $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                    if(count($category_ids) > 0) {
                        $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                    } else {
                        $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_products)->get()->pluck('product_id');
                    }

                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                } else {
                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::where('company_id', $company_id)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                }


            } elseif($stock == 'out_of_stock') {
                if(!empty($request->category_id)) {
                    $category_id = $request->category_id;
                    $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                    if(count($category_ids) > 0) {
                        $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_out_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                    } else {
                        $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_out_products)->get()->pluck('product_id');
                    }

                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                } else {
                    if(!empty($request->seller_id)) {
                        $seller_id = $request->seller_id;
                        $company_id = Seller::where('id', $seller_id)->first()->company_id;
                        $products = Product::where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    } else {
                        $products = Product::whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                    }
                }
            }
        } else {
            if(!empty($request->seller_id)) {
                $seller_id = $request->seller_id;
                $company_id = Seller::where('id', $seller_id)->first()->company_id;

                if(!empty($request->category_id)) {
                    $category_id = $request->category_id;
                    $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                    if(count($category_ids) > 0) {
                        $product_ids = ProductCategory::whereIn('category_id', $category_ids)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                    } else {
                        $product_ids = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
                    }
                    $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::where('company_id', $company_id)->where('status', 1)->with('brand')->orderBy('id','desc')->paginate(10);
                }
            } else {
                if(!empty($request->category_id)) {
                    $category_id = $request->category_id;
                    $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                    if(count($category_ids) > 0) {
                        $product_ids = ProductCategory::whereIn('category_id', $category_ids)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                    } else {
                        $product_ids = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
                    }
                    $products = Product::whereIn('id', $product_ids)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::where('status', 1)->with('brand')->orderBy('id','desc')->paginate(10);
                }
            }
        }


        return response()->json([
            'products' => $products
        ], 200);
    }

    // Product Stock Filter
    public function proStockFilter(Request $request) {
        $stock = $request->stock;

        $products = Product::where('status', 1)->get();
        $stock_products = array();
        $stock_out_products = array();
        foreach ($products as $product) {
            $stockIn = StockLedger::where('product_id', $product->id)->get()->pluck('stock_in')->toArray();
            $stockOut = StockLedger::where('product_id', $product->id)->get()->pluck('stock_out')->toArray();

            $stockQty = array_sum($stockIn)-array_sum($stockOut);
            if ($stockQty>0) {
                $stock_products[]= $product->id;
            }
            if($stockQty <= 0) {
                $stock_out_products[] = $product->id;
            }
        }

        if($stock == 'in_stock') {
            if(!empty($request->category_id)) {
                $category_id = $request->category_id;
                $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                if(count($category_ids) > 0) {
                    $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                } else {
                    $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_products)->get()->pluck('product_id');
                }

                if(!empty($request->seller_id)) {
                    $seller_id = $request->seller_id;
                    $company_id = Seller::where('id', $seller_id)->first()->company_id;
                    $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                }
            } else {
                if(!empty($request->seller_id)) {
                    $seller_id = $request->seller_id;
                    $company_id = Seller::where('id', $seller_id)->first()->company_id;
                    $products = Product::where('company_id', $company_id)->whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::whereIn('id', $stock_products)->with('brand')->orderBy('id','desc')->paginate(10);
                }
            }


        } elseif($stock == 'out_of_stock') {
            if(!empty($request->category_id)) {
                $category_id = $request->category_id;
                $category_ids = Category::where('parent_id', $category_id)->get()->pluck('id');

                if(count($category_ids) > 0) {
                    $product_ids = ProductCategory::whereIn('category_id', $category_ids)->whereIn('id', $stock_out_products)->orWhere('category_id', $category_id)->get()->pluck('product_id');
                } else {
                    $product_ids = ProductCategory::where('category_id', $category_id)->whereIn('id', $stock_out_products)->get()->pluck('product_id');
                }

                if(!empty($request->seller_id)) {
                    $seller_id = $request->seller_id;
                    $company_id = Seller::where('id', $seller_id)->first()->company_id;
                    $products = Product::whereIn('id', $product_ids)->where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::whereIn('id', $product_ids)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                }
            } else {
                if(!empty($request->seller_id)) {
                    $seller_id = $request->seller_id;
                    $company_id = Seller::where('id', $seller_id)->first()->company_id;
                    $products = Product::where('company_id', $company_id)->whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(10);
                } else {
                    $products = Product::whereIn('id', $stock_out_products)->with('brand')->orderBy('id','desc')->paginate(20);
                }
                // dd($stock_out_count);
            }
        } else {
            $products = Product::where('status', 1)->with('brand')->orderBy('id','desc')->paginate(10);
        }
        return response()->json([
            'products' => $products
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

    public function productAddonList(Request $request)
    {
        $products = Product::where('add_on', 1)->select('id','product_name')->get();
        return response()->json([
            'products'      => $products
        ], 200);

    }

    public function productAddonChange(Request $request)
    {

        $selected_product = $request->product_id;
        $addon_products     = $request->addon_product;
        foreach ($request->add_on as $item){
            DB::table('addon_products')->updateOrInsert([
                'product_id' => $request->product_id,
                'addon_products' => $item
            ]);
        }
        $product = Product::find($selected_product);

        $product->update([
            'add_on' => 1
        ]);

        return response()->json('Success');
    }

    public function get_addon_products () {
        // $products = Product::where('status', 1)->get();
        $products = Product::select('id', 'product_name')->where('status', 1)->get();
        return response()->json([
            'products' => $products
        ], 200);
    }

    public function show_addon_product($id) {
        $product = new Product();
        $products = Product::select('id', 'product_name')->where('id', $id)->get();

        $Alladdon_products = Addon_product::select('addon_products')->where('product_id', $id)->get();

        $addon_product_name = Product::whereIn('id', $Alladdon_products)->select('product_name')->get();

        return response()->json([
            'products' => $products,
            'addon_product_name' => $addon_product_name,
        ], 200);

    }

    public function productAddonUpdate(Request $request, $id)
    {

        $Addon = Addon_product::where('product_id', $id)->get();
        $addon_products     = $request->add_on;
        $update_addon = Addon_product::where('product_id', '=', $id)->delete();
        foreach ($request->add_on as $item){
            Addon_product::insert([
                'product_id' => $id,
                'addon_products' => $item
            ]);
        }
        // $update_addon->save();
        $product = Product::find($id);

        $product->update([
            'add_on' => 1
        ]);

        return response()->json('Success');
    }

    public function lowstockproduct() {
        $products = Product::where('status', 1)->select('id','product_name')->get();
        $stock_out_products = array();
        $low_stock_products = [];


        foreach ($products as $product) {

            $stockQty = Helper::productStock($product->id);

            if($stockQty <= 0) {
                $stock_out_products[] = $product->id;
            }
            if($stockQty <= 3) {
                $low_stock_products[] = array(
                    "id" => $product->id,
                    "product_name" => $product->product_name
                );
            }
        }
        $low_stock_product_count = count($low_stock_products);
        return response()->json([
            'low_stock_products' => $low_stock_products,
            'low_stock_product_count' => $low_stock_product_count
        ]);
    }

    public function low_stock_count()
    {
        $low_stock_count = Helper::lowstockcount();

        return response()->json([
            'low_stock_count' => $low_stock_count
        ]);
    }


    public function addonDelete($id)
    {
        $product = Product::find($id);

        $product->update([
            'add_on' => 0
        ]);
        $update_addon = Addon_product::where('product_id', '=', $id)->delete();
        return response()->json('Deleted successfully');
    }

}

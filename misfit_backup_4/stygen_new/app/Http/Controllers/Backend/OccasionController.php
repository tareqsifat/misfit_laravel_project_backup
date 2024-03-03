<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOccasion;
use App\Models\StockLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class OccasionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $occasions = Occasion::orderBy('id','desc')->paginate(10);
        // return response()->json([
        //     'occasions' => $occasions
        // ], 200);
        $occasions =  Occasion::orderBy('id','desc')->paginate(10);

        return response()->json([
            'occasions' => $occasions
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
        $request->validate([
            'occasion_name'  => 'required',
            'occasion_image' => 'required'
        ]);

        if($request->hasFile('occasion_image')){
            $image = $request->file('occasion_image');
            $upload_path = public_path('assets/uploads/occasion');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);
        }else{
            $name = NULL;
        }

        if($request->hasFile('meta_image')){
            $meta_image = $request->file('meta_image');
            $upload_path = public_path('assets/uploads/occasion/meta');
            $meta_image_name = time() . '-' . $meta_image->getClientOriginalName();
            $meta_image->move($upload_path, $meta_image_name);
        }else{
            $meta_image_name = NULL;
        }

        $occasion = Occasion::create([
            'occasion_name'         => $request->occasion_name,
            'occasion_slug'         => Str::slug($request->occasion_name),
            'occasion_image'        => $name,
            'showing_landing'       => ($request->status == 'true'?1:0),
            'meta_title'            => $request->meta_title,
            'meta_description'      => $request->meta_description,
            'meta_image'            => $meta_image_name,
            'status'                => ($request->status == 'true'?1:0),
        ]);
        return 'Success';
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $occasion_old = Occasion::find($id);

        if($request->hasFile('occasion_image')){
            $image = $request->file('occasion_image');
            $upload_path = public_path('assets/uploads/occasion');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);

            $existImage = public_path('assets/uploads/occasion/'.$occasion_old->occasion_image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
        }else{
            $name = $occasion_old->occasion_image;
        }

        if($request->hasFile('meta_image')){
            $meta_image = $request->file('meta_image');
            $upload_path = public_path('assets/uploads/occasion/meta');
            $meta_image_name = time() . '-' . $meta_image->getClientOriginalName();
            $meta_image->move($upload_path, $meta_image_name);

            $existMetaImage = public_path('assets/uploads/occasion/meta/'.$occasion_old->meta_image);
            if(file_exists($existMetaImage)){
                @unlink($existMetaImage);
            }
        }else{
            $meta_image_name = $occasion_old->meta_image;
        }

        $occasion = Occasion::where('id', $id)->update([
            'occasion_name'         => $request->occasion_name,
            'occasion_slug'         => Str::slug($request->occasion_name),
            'occasion_image'        => $name,
            'showing_landing'       => ($request->status == 'true'?1:0),
            'meta_title'            => $request->meta_title,
            'meta_description'      => $request->meta_description,
            'meta_image'            => $meta_image_name,
            'status'                => ($request->status == 'true'?1:0),
        ]);
        return 'Success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $occasion = Occasion::find($id);
        $occasion->update(['status' => 0]);
        $existImage = public_path('assets/uploads/occasion/'.$occasion->occasion_image);
        if(file_exists($existImage)){
            @unlink($existImage);
        }
        Occasion::find($id)->delete();
        return $this->index();
    }

    //Multiple Occasion Delete
    public function multipleOccasionDelete(Request $request){
        foreach ($request->all()  as $occasion){
            $occasion_old = Occasion::find($occasion['id']);
            $occasion_old->update(['status' => 0]);
            $existImage = public_path('assets/uploads/occasion/'.$occasion_old->occasion_image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
            Occasion::find($occasion['id'])->delete();
        }
        return 'Success';
    }

    public function getAllOccasion(){
        $occasions = Occasion::where('status', 1)->get();
        return response()->json([
            'occasions' => $occasions
        ], 200);
    }

    // Occasion Change Product Show
    public function getOccasionProducts(Request $request) {
        $occasion_id = $request->occasion_id;
        $occasion = Occasion::where('id', $occasion_id)->select('id')->first();

        $products = [];
        if(isset($occasion)){
            $search = $request->keyword;
            if(!empty($search)){
                $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                            ->where('product_occasions.occasion_id', $occasion->id)
                            ->where('products.status', 1)
                            ->select('products.*', 'product_occasions.occasion_id', 'product_occasions.status as occasion_status')
                            ->where(function ($query) use ($search) {
                                $query->where("products.product_name", "LIKE", "%{$search}%")
                                    ->orWhere("products.product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("products.regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("products.sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("products.quantity", "LIKE", "%{$search}%")
                                    ->orWhere("products.created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('products.product_view','asc')
                            ->with('brand', 'stock_ledger')
                            ->paginate(10);
            } else{
                $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                        ->where('product_occasions.occasion_id', $occasion->id)
                        ->where('products.status', 1)
                        ->select('products.*', 'product_occasions.occasion_id', 'product_occasions.status as occasion_status')
                        ->orderBy('products.product_view','asc')
                        ->with('brand', 'stock_ledger')
                        ->paginate(10);

                // $productIds = ProductOccasion::where('occasion_id', $occasion->id)->get()->pluck('product_id');
                // if(!empty($productIds)){
                //     $products = Product::where('status', 1)->whereIn('id', $productIds)->orderBy('product_view','asc')->with('stock_ledger','brand','product_categories','product_images','product_variations')->paginate(10);
                // }
            }
        }
        return response()->json([
            'products' => $products
        ], 200);
    }

    // Occassion Product List
    public function occassionProductList(Request $request) {
        $occasion_id = $request->occasion_id;
        if($occasion_id) {
            $occasion = Occasion::where('id', $occasion_id)->where('status', 1)->select('id')->first();
        } else {
            $occasion = Occasion::where('status', 1)->select('id')->orderBy('id', 'asc')->first();
        }
        // $productIds = ProductOccasion::where('occasion_id', $occasion->id)->get()->pluck('product_id');
        // $products = Product::whereIn('id', $productIds)->where('status', 1)->orderBy('product_view','asc')->with('brand', 'stock_ledger')->paginate(10);
        $search = $request->keyword;
        if(!empty($search)){
            $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                        ->where('product_occasions.occasion_id', $occasion->id)
                        ->where('products.status', 1)
                        ->select('products.*', 'product_occasions.occasion_id', 'product_occasions.status as occasion_status')
                        ->where(function ($query) use ($search) {
                            $query->where("products.product_name", "LIKE", "%{$search}%")
                                ->orWhere("products.product_sku", "LIKE", "%{$search}%")
                                ->orWhere("products.regular_price", "LIKE", "%{$search}%")
                                ->orWhere("products.sales_price", "LIKE", "%{$search}%")
                                ->orWhere("products.quantity", "LIKE", "%{$search}%")
                                ->orWhere("products.created_at", "LIKE", "%{$search}%");
                        })
                        ->orderBy('products.product_view','asc')
                        ->with('brand', 'stock_ledger')
                        ->paginate(10);
        } else{
            $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                        ->where('product_occasions.occasion_id', $occasion->id)
                        ->where('products.status', 1)
                        ->select('products.*', 'product_occasions.occasion_id', 'product_occasions.status as occasion_status')
                        ->orderBy('products.product_view','asc')
                        ->with('brand', 'stock_ledger')
                        ->paginate(10);
        }

        return response()->json([
            'products'      => $products
        ], 200);
    }

    public function occassionProductVisibility(Request $request) {
        $product_id = $request->product_id;
        $occasion_visibility = $request->occasion_visibility;
        $occasion_id = $request->occasion_id;

        $occasion = ProductOccasion::where('product_id', $product_id)->where('occasion_id', $occasion_id)->first();
        $occasion->update([
            'status' => $occasion_visibility
        ]);


        // Product::where('id', $product_id)->update([
        //     'occasion_visibility' => $occasion_visibility
        // ]);
        if($occasion) {
            return 'success';
        }
    }

    //Search
    public function searchOccassionProduct(Request $request)
    {
        $search = $request->keyword;
        $occasion_id = $request->occasion_id;
        if($occasion_id) {
            $occasion = Occasion::where('id', $occasion_id)->where('status', 1)->select('id')->first();
        } else {
            $occasion = Occasion::where('status', 1)->select('id')->orderBy('id', 'asc')->first();
        }
        if(!empty($search)){
            $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                        ->where('product_occasions.occasion_id', $occasion->id)
                        ->where('products.status', 1)
                        ->select('products.*', 'product_occasions.occasion_id', 'product_occasions.status as occasion_status')
                        ->where(function ($query) use ($search) {
                            $query->where("products.product_name", "LIKE", "%{$search}%")
                                ->orWhere("products.product_sku", "LIKE", "%{$search}%")
                                ->orWhere("products.regular_price", "LIKE", "%{$search}%")
                                ->orWhere("products.sales_price", "LIKE", "%{$search}%")
                                ->orWhere("products.quantity", "LIKE", "%{$search}%")
                                ->orWhere("products.created_at", "LIKE", "%{$search}%");
                        })
                        ->orderBy('products.product_view','asc')
                        ->with('brand', 'stock_ledger')
                        ->paginate(10);

        } else {
            $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                        ->where('product_occasions.occasion_id', $occasion->id)
                        ->where('products.status', 1)
                        ->select('products.*', 'product_occasions.occasion_id', 'product_occasions.status as occasion_status')
                        ->orderBy('products.product_view','asc')
                        ->with('brand', 'stock_ledger')
                        ->paginate(10);
        }
        return response()->json([
            'products'      => $products
        ], 200);
    }

    public function catOccasionWiseProduct(Request $request) {
        $category_id = $request->category_id;
        $occasion_id = $request->occasion_id;
        $products = [];
        if(!empty($category_id)) {
            $productIds = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
            if(!empty($productIds)){
                $products = Product::where('status', 1)
                        ->whereIn('id', $productIds)
                        ->orderBy('product_view','desc')
                        ->with('product_images')
                        ->paginate(12);
            }
        } else {
            if(!empty($occasion_id)) {
                $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                    ->where('product_occasions.occasion_id', $occasion_id)
                    ->where('products.status', 1)
                    ->select('products.*', 'product_occasions.occasion_id', 'product_occasions.status as occasion_status')
                    ->orderBy('products.product_view','asc')
                    ->with('product_images')
                    ->paginate(12);
            }
        }
        return response()->json([
            'products' => $products
        ], 200);
    }
    public function catOccasionWiseProductIds(Request $request) {
        $category_id = $request->category_id;
        $occasion_id = $request->occasion_id;
        $products = [];
        if(!empty($category_id)) {
            $productIds = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
            if(!empty($productIds)){
                if(!empty($occasion_id)) {
                    $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                        ->whereIn('products.id', $productIds)
                        ->where('product_occasions.occasion_id', $occasion_id)
                        ->where('products.status', 1)
                        ->where('product_occasions.status', 1)
                        ->orderBy('products.product_view','desc')
                        ->distinct('products.id')
                        ->pluck('products.id')
                        ->toArray();
                } else {
                    $products = Product::where('status', 1)
                        ->whereIn('id', $productIds)
                        ->orderBy('product_view','desc')
                        ->select('id')
                        ->get()
                        ->pluck('id');
                }
            }
        } else {
            if(!empty($occasion_id)) {
                $products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                    ->where('product_occasions.occasion_id', $occasion_id)
                    ->where('products.status', 1)
                    ->where('product_occasions.status', 1)
                    ->orderBy('products.product_view','desc')
                    ->distinct('products.id')
                    ->pluck('products.id')
                    ->toArray();
            }
        }
        return response()->json([
            'product_ids' => $products
        ], 200);
    }
    public function occassionWiseProductUpdate(Request $request) {
        $product_ids = $request->product_ids;
        $occasion_id = $request->occasion_id;
        $category_id = $request->category_id;

        if(!empty($occasion_id)) {
            if(!empty($category_id)) {
                $productIds = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
                $occasion_products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                        ->whereIn('products.id', $productIds)
                        ->where('product_occasions.occasion_id', $occasion_id)
                        ->where('products.status', 1)
                        ->distinct('products.id')
                        ->pluck('products.id')
                        ->toArray();
            } else {
                $occasion_products = Product::join('product_occasions', 'product_occasions.product_id', '=', 'products.id')
                    ->where('product_occasions.occasion_id', $occasion_id)
                    ->where('products.status', 1)
                    ->pluck('products.id')
                    ->toArray();
            }
        } else {
            $productIds = ProductCategory::where('category_id', $category_id)->get()->pluck('product_id');
            $occasion_products = Product::where('status', 1)
                        ->whereIn('id', $productIds)
                        ->pluck('products.id')
                        ->toArray();
        }

        // Deselected Occassion Products
        $deselected_productIds = array_diff($occasion_products,$product_ids);
        if(!empty($deselected_productIds)) {
            foreach($deselected_productIds as $deselected_product) {
                $occasion = ProductOccasion::where('product_id', $deselected_product)->where('occasion_id', $occasion_id)->first();
                $occasion->update([
                    'status' => 0
                ]);
                $product = ProductOccasion::where('product_id', $deselected_product)->where('status', 1)->pluck('occasion_id')->toArray();
                Product::where('id', $deselected_product)->where('status', 1)->update([
                    'occasion_id' => $product
                ]);
            }
        }

        // Selected Occasion Products
        if(count($product_ids) > 0) {
            foreach($product_ids as $product_id) {
                $product_occassion = ProductOccasion::where('product_id', $product_id)->where('occasion_id', $occasion_id)->first();
                if(isset($product_occassion)) {
                    if($product_occassion->status == 0) {
                        $product_occassion->update([
                            'status' => 1
                        ]);
                    }
                } else {
                    ProductOccasion::create([
                        'product_id'    => $product_id,
                        'occasion_id'   => $occasion_id,
                        'status'        => 1
                    ]);
                }
                $product = ProductOccasion::where('product_id', $product_id)->where('status', 1)->pluck('occasion_id')->toArray();
                Product::where('id', $product_id)->where('status', 1)->update([
                    'occasion_id' => $product
                ]);
            }
        }

        return response()->json([
            'success' => 'Product added to this occassion'
        ], 200);
    }
}

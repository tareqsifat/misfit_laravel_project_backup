<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CartManagerController;
use App\Models\Attribute;
use App\Models\AttributeValue;
// use App\Models\Addon_product;
use App\Models\Brand;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\ProductOccasion;
use App\Models\ProductRecipient;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        if(!\Request::ajax()){
            return abort(404);
        }else{
            $products = Product::where('status', 1)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations')->paginate(30);
            return response()->json([
                'products' => $products
            ], 200);
        }
    }

    
    public function search_product() {

        $query = Product::where('status', 1);
        $key = request()->key;
        if(strlen($key) > 0) {
            $query->where(function ($q) use ($key) {
                $q->Where('product_name', 'LIKE', '%' . $key . '%')
                ->orWhere('product_sku', 'LIKE', '%' . $key . '%');
            })->select('id', 'regular_price', 'pro_slug' ,'sales_price','product_name', 'featured_image');
            $search_products = $query->take(10)->get();

            $result = view('frontend.inc.search_result', compact('search_products'))->render();

            return response()->json([
                'status' => true,
                'result' => $result,
                'message' => 'Data loaded',
            ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ]);
        }
    }

    // add to cart
    public function add_to_cart() {
        $cart = new CartManagerController();
        $cart->add_to_cart(request()->id, request()->qty);
        return response()->json([
            'cart' => $cart->get(),
            "message" => "Product added to cart successfully",
            'cart_count' => $cart->cart_count(),
        ], 200);
    }

    // clear cart
    public function clear_cart()
    {
        session()->forget('carts');
    }

    public function cart_all()
    {
        $cart = new CartManagerController();
        $carts = $cart->get();
        // ddd(session()->get('carts'));
        $html = view('livewire.frontend.components.cart', compact('carts'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'Data loaded',
        ]);
    }

    public function filterByVariation(Request $request){
        if(!\Request::ajax()){
            return abort(404);
        }else{
            $variation = $request->variation;
            $products = Product::join('product_variations','product_variations.product_id','=','products.id')
                ->where('products.status', 1)
                ->where('product_variations.color', $variation)
                ->orWhere('product_variations.size', $variation)
                ->orWhere('product_variations.weight', $variation)
                ->orderBy('products.id','desc')
                ->select('products.*')
                ->with('brand','product_categories','product_images','product_variations')
                ->paginate(30);
            return response()->json([
                'products' => $products
            ], 200);
        }
    }

    public function category_product(Request $request){
        $cat_slug = $request->cat_slug;
        $category = Category::where('cat_slug', $cat_slug)->select('id','cat_slug')->first();

        if(!\Request::ajax()){
            return abort(404);
        }else{
            $products = [];
            if(isset($category)){
                $productIds = ProductCategory::where('category_id', $category->id)->get()->pluck('product_id');
                if(!empty($productIds)){
                    $products = Product::where('status', 1)->whereIn('id', $productIds)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations')->paginate(30);
                    return response()->json([
                        'products' => $products
                    ], 200);
                }else{
                    return response()->json([
                        'products' => $products
                    ], 200);
                }
            }
        }
    }

    public function category_product_slug(Request $request){
        $cat_slug = $request->cat_slug;
        $category = Category::where('cat_slug', $cat_slug)->select('id','cat_slug','category_name','meta_title')->first();
        if(isset($category)){
            return response()->json($category);
        }else{
            return response()->json('error');
        }
    }

    public function occasion_product(Request $request){
        $occasion_slug = $request->occasion_slug;
        $occasion = Occasion::where('occasion_slug', $occasion_slug)->select('id','occasion_slug')->first();

        if(!\Request::ajax()){
            return abort(404);
        }else{
            $products = [];

            if(isset($occasion)){
                $productIds = ProductOccasion::where('occasion_id', $occasion->id)->where('status', 1)->get()->pluck('product_id');
                if(!empty($productIds)){
                    $products = Product::where('status', 1)->whereIn('id', $productIds)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations')->paginate(30);
                    $product_categories = ProductCategory::where('status',1)->whereIn('product_id', $productIds)->select('category_id')->get();
                    $categories = Category::where('status', 1)->whereIn('id', $product_categories)->select('id','category_name')->get();

                    return response()->json([
                        'products' => $products,
                        'ocassion_categories' => $categories
                    ], 200);
                }else{
                    return response()->json([
                        'products' => $products,
                    ], 200);
                }
            }
        }
    }

    public function ocassion_product_filter(Request $request) {
        $occasion_slug = $request->occasion_slug;
        $occasion = Occasion::where('occasion_slug', $occasion_slug)->select('id','occasion_slug')->first();
        $occasion_cat[] = $request->occasion_cat;

        // $occasion_cat = is_array($occasion_cat) ? $occasion_cat : [$occasion_cat];
        if($request->occasion_cat == 'all') {
            $occasion_slug = $request->occasion_slug;
            $occasion = Occasion::where('occasion_slug', $occasion_slug)->select('id','occasion_slug')->first();

            if(!\Request::ajax()){
                return abort(404);
            }else{
                $products = [];
                if(isset($occasion)){
                    $productIds = ProductOccasion::where('occasion_id', $occasion->id)->where('status', 1)->get()->pluck('product_id');
                    if(!empty($productIds)){
                        $products = Product::where('status', 1)->whereIn('id', $productIds)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations')->paginate(30);
                        return response()->json([
                            'products' => $products,
                        ], 200);
                    }else{
                        return response()->json([
                            'products' => $products,
                        ], 200);
                    }
                }
            }

        }
        else {
            if(!\Request::ajax()){
                return abort(404);
            }else{
                $products = [];
                    $productIds = ProductOccasion::where('occasion_id', $occasion->id)->where('status', 1)->get()->pluck('product_id');
                    $productCats = ProductCategory::where('category_id',$occasion_cat)->where('status', 1)->get()->pluck('product_id');

                    // $products = Product::where('status', 1)->whereIn('id', $productIds)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations')->paginate(30);
                    $products = Product::where('status', 1)->whereIn('id', $productCats)->whereIn('id', $productIds)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations')->paginate(500);
                    return response()->json([
                        'products' => $products,
                        // 'ocassion_categories' => $categories
                    ], 200);
            }
        }


    }

    public function occasion_product_categories(Request $request) {
        $occasion_slug = $request->occasionSlug;
        $occasion = Occasion::where('occasion_slug', $occasion_slug)->select('id','occasion_slug')->first();
        if(!\Request::ajax()){
            return abort(404);
        }else{
            // $products = [];
            $productIds = ProductOccasion::where('occasion_id', $occasion->id)->where('status', 1)->get()->pluck('product_id');
            if(!empty($productIds)){
                $product_categories = ProductCategory::where('status',1)->whereIn('product_id', $productIds)->select('category_id')->get();
                $categories = Category::where('status', 1)->whereIn('id', $product_categories)->select('id','category_name')->orderBy('id','desc')->get();
                $categories[] = ['category_name'=>'All', 'id' => 'all'];
                return response()->json([
                    'ocassion_categories' => $categories
                ], 200);
            }
        }
    }

    public function brand_product(Request $request){
        $brand_slug = $request->brand_slug;
        $brand = Brand::where('brand_slug', $brand_slug)->select('id')->first();

        if(!\Request::ajax()){
            return abort(404);
        }else{
            $products = [];
            if(isset($brand)){
                $products = Product::where('status', 1)->where('brand_id', $brand->id)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations')->paginate(30);
                    return response()->json([
                        'products' => $products
                    ], 200);
            } else {
                return response()->json([
                    'products' => $products
                ], 200);
            }
        }
    }

    public function occasion_product_slug(Request $request){
        $occasion_slug = $request->occasion_slug;
        $occasion = Occasion::where('occasion_slug', $occasion_slug)->select('id','occasion_slug','occasion_name')->first();
        if(isset($occasion)){
            return response()->json($occasion);
        }else{
            return response()->json('error');
        }
    }

    public function productOccassionName(Request $request){
        $occasionSlug = $request->occasionSlug;
        $occasion = Occasion::where('occasion_slug', $occasionSlug)->select('id','occasion_slug','occasion_name')->first();
        if(isset($occasion)){
            return response()->json($occasion);
        }else{
            return response()->json('error');
        }
    }

    public function single_product($slug){
        $product = Product::where('pro_slug', $slug)->with('brand','product_categories','product_images','product_variations','reviews')->first();

        $color_count = 0;
        $size_count = 0;
        $weight_count = 0;

        if(!empty($product->product_variations)) {
            $color = [];
            $size = [];
            $weight = [];
            $colors = ProductVariation::where('product_id', $product->id)->where('color', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['color','color_code']);
            $sizes = ProductVariation::where('product_id', $product->id)->where('size', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['size']);
            $weights = ProductVariation::where('product_id', $product->id)->where('weight', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['weight']);
            foreach($product->product_variations as $product_variation) {
                if(!empty($product_variation->color)) {
                    array_push($color, $product_variation->color);
                }
                if(!empty($product_variation->size)) {
                    array_push($size, $product_variation->size);
                }
                if(!empty($product_variation->weight)) {
                    array_push($weight, $product_variation->weight);
                }
            }
            $color_count = count($color);
            $size_count = count($size);
            $weight_count = count($weight);
        }
        $all_attributes = [
            'color_count'   => $color_count,
            'size_count'    => $size_count,
            'weight_count'  => $weight_count,
            'colors'        => $colors,
            'sizes'         => $sizes,
            'weights'       => $weights
        ];

        // dd([
        //     // 'product' => $product,
        //     'addon_products' => $addon_products
        //     // 'all_attributes' => $all_attributes
        // ]);
        return response()->json([
            'product' => $product,
            'all_attributes' => $all_attributes
        ], 200);
    }

    public function related_product($slug){
        // $product = Product::where('pro_slug', $slug)->select('id')->first();
        // $parent_category = Category::join('product_categories','product_categories.category_id','=','categories.id')
        //                     ->where('categories.parent_id', 0)
        //                     ->where('product_categories.product_id', $product->id)
        //                     ->select('categories.id')
        //                     ->first();
        // $product_ids = ProductCategory::where('category_id', $parent_category->id)->distinct()->pluck('product_id');
        // $related_products = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->with('brand','product_categories','product_images','product_variations','reviews')->take(4)->get();
        // return response()->json([
        //     'related_products' => $related_products
        // ], 200);

        $product = Product::where('pro_slug', $slug)->select('id')->first();
        $related_product_ids = [];

        // // Get Product by Occassion
        // $occasionIds = ProductOccasion::where('product_id', $product->id)->get()->pluck('occasion_id');
        // if(!empty($occasionIds)) {
        //     $occasion_product_ids = ProductOccasion::whereIn('occasion_id', $occasionIds)->where('status', 1)->distinct()->pluck('product_id');
        //     // $occasion_products = Product::whereIn('id', $occasion_product_ids)->where('id', '!=', $product->id)->with('brand','product_categories','product_images','product_variations','reviews')->get()->random(1);
        //     // array_push($related_products, $occasion_products['id']);
        //     if(count($occasion_product_ids) > 0) {
        //         $occasion_id = ProductOccasion::whereIn('occasion_id', $occasionIds)->where('status', 1)->select('product_id')->get()->random(1);
        //         foreach($occasion_id as $occasion) {
        //             array_push($related_product_ids, $occasion->product_id);
        //         }
        //     }
        // }

        // // Get Product by Recepient
        // $recipientIds = ProductRecipient::where('product_id', $product->id)->get()->pluck('recipient_id');
        // if(!empty($recipientIds)) {
        //     $recipient_product_ids = ProductRecipient::whereIn('recipient_id', $recipientIds)->where('status', 1)->distinct()->pluck('product_id');
        //     // $recipient_products = Product::whereIn('id', $recipient_product_ids)->where('id', '!=', $product->id)->with('brand','product_categories','product_images','product_variations','reviews')->get()->random(1);
        //     // array_push($related_products, $recipient_products->id);
        //     if(count($recipient_product_ids) > 0) {
        //         $recipient_id = ProductRecipient::whereIn('recipient_id', $recipientIds)->where('status', 1)->select('product_id')->get()->random(1);
        //         foreach($recipient_id as $recipient) {
        //             array_push($related_product_ids, $recipient->product_id);
        //         }
        //     }
        // }


        // Get Product by Category
        $category = ProductCategory::where('product_id', $product->id)->get()->pluck('category_id');
        if(!empty($category)) {
            $parent_category = Category::where('parent_id', 0)->whereIn('id', $category)->get();
            if($parent_category->count() > 0) {
                $parent_category = $parent_category->pluck('id');
            } else {
                $parent_category = Category::whereIn('id', $category)->get()->pluck('parent_id');
            }
            $product_ids = ProductCategory::where('category_id', $parent_category)->distinct()->pluck('product_id');

            if(count($related_product_ids) == 2) {
                if(count($product_ids) > 0) {
                    $relatedProduct = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->get();
                    if($relatedProduct->count() > 2){
                        $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random(2);
                    }else{
                        $rand_id = $relatedProduct->count();
                        $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random($rand_id);
                    }
                    foreach($product_ids as $product_id) {
                        array_push($related_product_ids, $product_id->id);
                    }
                }
            }

            if(count($related_product_ids) == 1) {
                if(count($product_ids) > 0) {
                    $relatedProduct = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->get();
                    $rand_id = $relatedProduct->count();
                    if($rand_id > 0) {
                        if($rand_id > 2) {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random(3);
                        } else {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random($rand_id);
                        }
                    }
                    foreach($product_ids as $product_id) {
                        array_push($related_product_ids, $product_id->id);
                    }
                }
            }

            if(count($related_product_ids) == 0) {
                if(count($product_ids) > 0) {
                    $relatedProduct = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->get();
                    $rand_id = $relatedProduct->count();
                    if($rand_id > 0) {
                        if($rand_id > 3) {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random(4);
                        } else {
                            $product_ids = Product::whereIn('id', $product_ids)->where('id', '!=', $product->id)->select('id')->get()->random($rand_id);
                        }
                    }
                    foreach($product_ids as $product_id) {
                        array_push($related_product_ids, $product_id->id);
                    }
                }
            }

        }

        $related_products = Product::whereIn('id', $related_product_ids)->where('id', '!=', $product->id)->with('brand','product_categories','product_images','product_variations','reviews')->get();

        return response()->json([
            'related_products' => $related_products
        ], 200);
    }

    public function singleProductCategory(Request $request){
        $slug = $request->product_slug;
        $product = Product::where('pro_slug', $slug)->select('id')->first();
        $parent_category = Category::join('product_categories','product_categories.category_id','=','categories.id')
                            ->where('categories.parent_id', 0)
                            ->where('product_categories.product_id', $product->id)
                            ->select('categories.id','categories.category_name', 'categories.cat_slug')
                            ->first();
        if(isset($parent_category)){
            $category_name = $parent_category->category_name;
            $cat_slug      = $parent_category->cat_slug;
        }else{
            $category_name = 'Uncategorized';
            $cat_slug      = '';
        }

        return response()->json([
            'category_name' => $category_name,
            'cat_slug'      => $cat_slug
        ], 200);
    }

    public function getViewContent(Request $request){
        $slug = $request->product_slug;
        $product = Product::where('pro_slug', $slug)->select('id','product_name','product_sku','regular_price','sales_price')->first();

        $id = $product->id;
        $price = $product->regular_price;
        $product_name = $product->product_name;
        $product_sku = $product->id;

        return response()->json([
            'price' => $price,
            'sku'   => $product_sku,
            'name' => $product_name,
            'id' => $id
        ], 200);
    }

    public function getVariations(Request $request){
        $product_id = $request->id;
        $product = Product::where('id', $product_id)->with('product_variations')->first();

        $color_count = 0;
        $size_count = 0;
        $weight_count = 0;

        if(!empty($product->product_variations)) {
            $color = [];
            $size = [];
            $weight = [];
            $colors = ProductVariation::where('product_id', $product->id)->where('color', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['color','color_code']);
            $sizes = ProductVariation::where('product_id', $product->id)->where('size', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['size']);
            $weights = ProductVariation::where('product_id', $product->id)->where('weight', '!=', '')->where('attribute_stock', '!=', '0')->distinct()->get(['weight']);

            foreach($product->product_variations as $product_variation) {
                if(!empty($product_variation->color)) {
                    array_push($color, $product_variation->color);
                }
                if(!empty($product_variation->size)) {
                    array_push($size, $product_variation->size);
                }
                if(!empty($product_variation->weight)) {
                    array_push($weight, $product_variation->weight);
                }
            }
            $color_count = count($color);
            $size_count = count($size);
            $weight_count = count($weight);
        }
        $all_attributes = [
            'color_count'   => $color_count,
            'size_count'    => $size_count,
            'weight_count'  => $weight_count,
            'colors'        => $colors,
            'sizes'         => $sizes,
            'weights'       => $weights
        ];

        return response()->json([
            'all_attributes' => $all_attributes
        ], 200);
    }

    public function getAllVariations(){
        $variations = Attribute::join('attribute_values','attributes.id','=','attribute_values.attribute_id')
            ->where('attributes.status', 1)
            ->groupBy('attribute_values.attribute_value')
            ->get();
        return response()->json([
            'variations' => $variations
        ], 200);
    }

    //Browse Category
    public function browseCategoryList(){
        $categories = Category::where('status', 1)->where('parent_id', 0)->orderBy('id','asc')->with('subcategory')->get();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    //Search Product
    public function searchProduct(Request $request){
        $search = $request->keyword;
        if($search != null){
            $products = Product::with('brand','product_categories','product_images','product_variations')
                ->where('status', 1)
                ->where('status', '!=', 0)
                ->where(function ($query) use ($search) {
                    $query->where("product_name", "LIKE", "%{$search}%")
                        ->orWhere("pro_slug", "LIKE", "%{$search}%")
                        ->orWhere("product_sku", "LIKE", "%{$search}%")
                        ->orWhere("regular_price", "LIKE", "%{$search}%")
                        ->orWhere("short_description", "LIKE", "%{$search}%")
                        ->orWhere("long_description", "LIKE", "%{$search}%");
                })
                ->orderBy('product_view','desc')
                ->paginate(30);
            return response()->json([
                'products' => $products
            ], 200);
        }else{
            return $this->index();
        }
    }

    public function singleProductView(Request $request) {
        $product = Product::where('pro_slug', $request->product_slug)->first();
        if(!empty($product)) {
            $product->increment('product_view', 1);
            return response()->json([
                'success'       => 'Product View',
                'id'            => $product->id,
                'product_name'  => $product->product_name,
                'meta_title'    => $product->meta_title,
                'meta_description'      => $product->meta_description,
                'meta_image'    => $product->featured_image,
            ], 200);
        }
    }

    public function productCategoryName(Request $request) {
        $category = Category::where('cat_slug', $request->category_slug)->first();
        if(!empty($category)) {
            return response()->json([
                'category_name'  => $category->category_name,
                'meta_title' => $category->meta_title,
                'meta_description' => $category->meta_description,
                'meta_image' => $category->meta_image
            ], 200);
        }
    }


    public function productBrandName(Request $request) {
        $brand = Brand::where('brand_slug', $request->brandSlug)->first();
        if(!empty($brand)) {
            return response()->json([
                'brand_name'  => $brand->brand_name
            ], 200);
        }
    }


    public function sortProduct(Request $request) {
        $search = (!empty($request->keyword))?$request->keyword:'';
        $sort_value = $request->sort_value;

        if(!empty($sort_value)) {
            if($sort_value == 'popularity') {
                $products = Product::where('status', 1)
                        ->where(function ($query) use ($search) {
                            $query->where("product_name", "LIKE", "%{$search}%")
                                ->orWhere("product_sku", "LIKE", "%{$search}%")
                                ->orWhere("regular_price", "LIKE", "%{$search}%")
                                ->orWhere("sales_price", "LIKE", "%{$search}%")
                                ->orWhere("quantity", "LIKE", "%{$search}%")
                                ->orWhere("created_at", "LIKE", "%{$search}%");
                        })
                        ->orderBy('product_view','desc')
                        ->with('brand','product_categories','product_images','product_variations')
                        ->paginate(30);
            }
            if($sort_value == 'avg_rating') {
                $products = Product::where('status', 1)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->where('average_ratting', '!=', NULL)
                            ->orderBy('average_ratting','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'latest') {
                $products = Product::where('status', 1)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('id','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'low_to_high') {
                $products = Product::where('status', 1)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('regular_price','asc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'high_to_low') {
                $products = Product::where('status', 1)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('regular_price','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
        } else {
            // $products = Product::where('status', 1)
            //             ->where(function ($query) use ($search) {
            //                 $query->where("product_name", "LIKE", "%{$search}%")
            //                     ->orWhere("product_sku", "LIKE", "%{$search}%")
            //                     ->orWhere("regular_price", "LIKE", "%{$search}%")
            //                     ->orWhere("sales_price", "LIKE", "%{$search}%")
            //                     ->orWhere("quantity", "LIKE", "%{$search}%")
            //                     ->orWhere("created_at", "LIKE", "%{$search}%");
            //             })
            //             ->orderBy('product_view','desc')
            //             ->with('brand','product_categories','product_images','product_variations')
            //             ->paginate(15);
            Product::where('status', 1)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('id','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
        }
        return response()->json([
            'products' => $products
        ], 200);
    }
    public function categoryProductSort(Request $request) {
        $search = (!empty($request->keyword))?$request->keyword:'';
        $sort_value = $request->sort_value;

        $cat_slug = $request->category_slug;
        $category = Category::where('cat_slug', $cat_slug)->select('id','cat_slug')->first();
        $products = [];
        if(isset($category)){
            $productIds = ProductCategory::where('category_id', $category->id)->get()->pluck('product_id');
        }

        if(!empty($sort_value)) {
            if($sort_value == 'popularity') {
                $products = Product::where('status', 1)
                        ->whereIn('id', $productIds)
                        ->where(function ($query) use ($search) {
                            $query->where("product_name", "LIKE", "%{$search}%")
                                ->orWhere("product_sku", "LIKE", "%{$search}%")
                                ->orWhere("regular_price", "LIKE", "%{$search}%")
                                ->orWhere("sales_price", "LIKE", "%{$search}%")
                                ->orWhere("quantity", "LIKE", "%{$search}%")
                                ->orWhere("created_at", "LIKE", "%{$search}%");
                        })
                        ->orderBy('product_view','desc')
                        ->with('brand','product_categories','product_images','product_variations')
                        ->paginate(30);
            }
            if($sort_value == 'avg_rating') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->where('average_ratting', '!=', NULL)
                            ->orderBy('average_ratting','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'latest') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('id','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'low_to_high') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('regular_price','asc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'high_to_low') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('regular_price','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
        } else {
            $products = Product::where('status', 1)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('id','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
        }
        return response()->json([
            'products' => $products
        ], 200);
    }
    public function occassionProductSort(Request $request) {
        $search = (!empty($request->keyword))?$request->keyword:'';
        $sort_value = $request->sort_value;

        $occasion_slug = $request->occasion_slug;

        $occasion = Occasion::where('occasion_slug', $occasion_slug)->select('id','occasion_slug')->first();

        if(isset($occasion)){
            $productIds = ProductOccasion::where('occasion_id', $occasion->id)->get()->pluck('product_id');
        }

        if(!empty($sort_value)) {
            if($sort_value == 'popularity') {
                $products = Product::where('status', 1)
                        ->whereIn('id', $productIds)
                        ->where(function ($query) use ($search) {
                            $query->where("product_name", "LIKE", "%{$search}%")
                                ->orWhere("product_sku", "LIKE", "%{$search}%")
                                ->orWhere("regular_price", "LIKE", "%{$search}%")
                                ->orWhere("sales_price", "LIKE", "%{$search}%")
                                ->orWhere("quantity", "LIKE", "%{$search}%")
                                ->orWhere("created_at", "LIKE", "%{$search}%");
                        })
                        ->orderBy('product_view','desc')
                        ->with('brand','product_categories','product_images','product_variations')
                        ->paginate(30);
            }
            if($sort_value == 'avg_rating') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->where('average_ratting', '!=', NULL)
                            ->orderBy('average_ratting','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'latest') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('id','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'low_to_high') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('regular_price','asc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
            if($sort_value == 'high_to_low') {
                $products = Product::where('status', 1)
                            ->whereIn('id', $productIds)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('regular_price','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
            }
        } else {
            $products = Product::where('status', 1)
                            ->where(function ($query) use ($search) {
                                $query->where("product_name", "LIKE", "%{$search}%")
                                    ->orWhere("product_sku", "LIKE", "%{$search}%")
                                    ->orWhere("regular_price", "LIKE", "%{$search}%")
                                    ->orWhere("sales_price", "LIKE", "%{$search}%")
                                    ->orWhere("quantity", "LIKE", "%{$search}%")
                                    ->orWhere("created_at", "LIKE", "%{$search}%");
                            })
                            ->orderBy('id','desc')
                            ->with('brand','product_categories','product_images','product_variations')
                            ->paginate(30);
        }
        return response()->json([
            'products' => $products
        ], 200);
    }

    public function singleProductQuantity(Request $request) {
        $slug = $request->slug;
        $product = Product::where('pro_slug', $slug)->select('id')->first();
        // dd($request->all(), $product);
        $product_quantity = Helper::productStock($product->id);

        return response()->json([
            'product_quantity' => $product_quantity
        ], 200);
    }
    //Product Feed
    public function product_feed()
    {
        $products = Product::select('id', 'product_name', 'pro_slug', 'featured_image', 'short_description','regular_price', 'sales_price','product_sku')
        ->where('status', 1)->get();

        return response()->view('product_feed', [
           'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }
}

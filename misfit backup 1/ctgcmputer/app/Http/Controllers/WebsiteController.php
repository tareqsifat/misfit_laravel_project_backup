<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use App\Models\WebsiteUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function website()
    {
        return view('frontend.home');
    }

    public function aboutus()
    {
        return view('frontend.aboutus');
    }

    public function privacy_policy()
    {
        return view('frontend.privacy_policy');
    }

    public function terms()
    {
        return view('frontend.terms');;
    }

    public function refund_policy()
    {
        return view('frontend.refund_policy');
    }

    public function product_details($id, $product_name)
    {
        $product = Product::where('id', $id)
            ->withSum('stocks', 'qty')
            ->withSum('sales', 'qty')
            ->with('product_brand')
            ->first();
        return view('frontend.product-details', compact('product'));
    }

    public function invoice_download($invoice)
    {
        $order_details = Order::where('invoice_id', $invoice)->with(['order_address', 'order_payments', 'order_details' => function ($q) {
            $q->with('product');
        }])->first();

        return view('backend.invoice', compact('order_details', $order_details));
    }

    public function search_product()
    {
        $key = request()->key;
        $products = Product::where('status', 1)
            ->where('sales_price','>',0)
            ->where(function($q) use ($key) {
                $q->where('product_name', $key)
                ->orWhere('sku', $key)
                ->orWhere('brand_id', $key)

                ->orWhere('product_name', 'LIKE', '%' . $key . '%')
                ->orWhere('sku', 'LIKE', '%' . $key . '%')
                ->orWhere('brand_id', 'LIKE', '%' . $key . '%');
            })

            ->select([
                'id',
                'product_name',
                'sales_price',
                'product_url',
            ])

            ->paginate(32);

        return view('frontend.search_products',compact('products','key'));
    }

    public function category_products($id, $category_name)
    {

        $category = Category::where('id', $id)->first();
        $min_product_price = Product::select('selected_categories', 'sales_price')->whereJsonContains('selected_categories', $id)->orderBy('sales_price', 'ASC')->first();
        $max_product_price = Product::select('selected_categories', 'sales_price')->whereJsonContains('selected_categories', $id)->orderBy('sales_price', 'DESC')->first();

        if ($min_product_price) {
            $min_product_price = $min_product_price->sales_price;
        } else {
            $min_product_price = 0;
        }

        if ($max_product_price) {
            $max_product_price = $max_product_price->sales_price;
        } else {
            $max_product_price = 0;
        }

        return view('frontend.category_products', compact('category', 'min_product_price', 'max_product_price'));
    }

    public function product_and_category_by_url($url, $url2 = null, $url3 = null)
    {
        $main_url = $url; // category or product url
        $sub_category_url = $url2;
        $brand_url = $url3;

        if ($url && $url2) {
            $url = $url . '/' . $url2;
        }

        $product = WebsiteUrl::where('table_name','products')->where('url',$url)->first();
        if ($product) {
            $product = Product::where('id',$product->table_id)->first();
            $product->withSum('stocks', 'qty')
                ->withSum('sales', 'qty')
                ->with('product_brand')
                ->first();
            return view('website.pages.product-details', compact('product'));
        }

        $category = WebsiteUrl::where('table_name','categories')->where('url',$url)->first();
        if ($category) {
            $category = Category::where('id', $category->table_id)->first();
            $id = $category->id;
            $min_product_price = 0;
            $max_product_price = 0;

            $min_product_price = Product::select('selected_categories', 'sales_price')->whereJsonContains('selected_categories', $id)->orderBy('sales_price', 'ASC')->first();
            $max_product_price = Product::select('selected_categories', 'sales_price')->whereJsonContains('selected_categories', $id)->orderBy('sales_price', 'DESC')->first();

            if ($min_product_price) {
                $min_product_price = $min_product_price->sales_price;
            }

            if ($max_product_price) {
                $max_product_price = $max_product_price->sales_price;
            }

            return view('website.pages.category', compact('category', 'min_product_price', 'max_product_price'));
        }

        $brand = WebsiteUrl::where('table_name','brands')->where('url',$url)->first();
        if ($brand) {
            $brand = Brand::where('id', $brand->table_id)->first();
            $min_product_price = Product::select('selected_categories', 'sales_price')->where('brand_id', $brand->id)->orderBy('sales_price', 'ASC')->first();
            $max_product_price = Product::select('selected_categories', 'sales_price')->where('brand_id', $brand->id)->orderBy('sales_price', 'DESC')->first();

            if ($min_product_price) {
                $min_product_price = $min_product_price->sales_price;
            } else {
                $min_product_price = 0;
            }

            if ($max_product_price) {
                $max_product_price = $max_product_price->sales_price;
            } else {
                $max_product_price = 0;
            }

            return view('frontend.category_products', compact('category', 'brand', 'min_product_price', 'max_product_price'));
        }

        $tag = WebsiteUrl::where('table_name','tags')->where('url',$url)->first();
        if ($tag) {
            $tag = Tag::where('url', $tag->table_id)->first();
            $min_product_price = Product::select('selected_categories', 'sales_price')
                ->whereExists(function ($query) use ($tag) {
                    $query->from('product_tag')
                        ->whereColumn('product_tag.product_id', 'products.id')
                        ->where('product_tag.tag_id', $tag->id);
                })
                ->orderBy('sales_price', 'ASC')->first();
            $max_product_price = Product::select('id','selected_categories', 'sales_price')
                ->whereExists(function ($query) use ($tag) {
                    $query->from('product_tag')
                        ->whereColumn('product_tag.product_id', 'products.id')
                        ->where('product_tag.tag_id', $tag->id);
                })
                ->orderBy('sales_price', 'DESC')->first();

            if ($min_product_price) {
                $min_product_price = $min_product_price->sales_price;
            } else {
                $min_product_price = 0;
            }

            if ($max_product_price) {
                $max_product_price = $max_product_price->sales_price;
            } else {
                $max_product_price = 0;
            }

            return view('frontend.category_products', compact('category', 'brand', 'tag', 'min_product_price', 'max_product_price'));
        }

        return view("frontend.errors.404");
    }

    public function add_to_cart(Request $request)
    {
        $cart = new CartController();
        $cart->add_to_cart($request->id, $request->qty, $request->size);
        return response()->json([
            'cart' => $cart->get(),
            "message" => "Cart added",
            'cart_count' => $cart->cart_count(),
            "cart_total" => $cart->cart_total(),
            "cart_total_formated" => number_format($cart->cart_total()),
        ], 200);
    }

    public function clear_cart()
    {
        session()->forget('carts');
    }

    public function single_product_details($id)
    {
        $product = Product::find($id);
        return view('livewire.quick-view-product', compact('product'))->render();
    }

    public function cart_all()
    {
        ddd(session()->get('carts'));
    }
}

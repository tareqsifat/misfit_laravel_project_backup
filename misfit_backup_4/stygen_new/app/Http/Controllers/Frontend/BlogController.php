<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAllBlog(){
        $all_blogs = Blog::where('status', 1)->paginate(10);
        return response()->json([
            'all_blogs' => $all_blogs
        ], 200);
    }

    public function getSingleBlog($slug){
        $blog = Blog::where('blog_slug', $slug)->where('status', 1)->first();
        // $blog_product = Product::whereIn('product_sku', $skus)->select('product_name', 'product_sku', 'short_description', 'featured_image', 'regular_price', 'sales_price')->get();
        return view('livewire.frontend.single_blog', compact('blog'));

    }
    public function blog_product($slug)
    {
        $blog = Blog::where('blog_slug', $slug)->where('status', 1)->select('id','blog_product_sku','description')->first();
        $skus = json_decode($blog->blog_product_sku);
        $blog_products = [];
        if(isset($skus)) {
            $blog_products = Product::whereIn('product_sku', $skus)->select('product_name', 'product_sku', 'short_description', 'featured_image', 'regular_price', 'sales_price','pro_slug')->get();
            $blog_product = $blog_products->unique('product_sku');
            $view = view('frontend.blog_product', compact('blog','blog_product'))->render();
            return response()->json([
                'blog' => $blog,
                'blog_product' => $blog_product,
                'view' => $view
            ], 200);
        }

        return response()->json([
            'blog' => $blog
        ], 200);


    }
    public function getSingleBlogName(Request $request) {
        $blog = Blog::where('blog_slug', $request->blog_slug)->first();
        return response()->json([
            'blog_name' => $blog->title
        ], 200);
    }
}

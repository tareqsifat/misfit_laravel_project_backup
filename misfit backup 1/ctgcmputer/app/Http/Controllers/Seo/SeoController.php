<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    public function index()
    {
        return view('seo_dashboard.dashboard');
    }

    public function seo_website()
    {
        return view('seo_dashboard.pages.website_seo');
    }

    public function seo_website_update()
    {
        $setting = Setting::first();
        $setting->fill(request()->except('seo_image', '_token'));
        if (request()->hasFile('seo_image')) {
            $setting->seo_image = Storage::put("seo/website", request()->file('seo_image'));
        }
        $setting->save();
        return redirect()->back()->with('success', "data updated successfully");
    }

    public function ctegories()
    {

        $categories = Category::paginate(10);
        if (request()->has("key")) {
            $key = request()->key;
            $categories = Category::where('name', $key)->orWhere(function ($q) use ($key) {
                return $q->where('name', "LIKE", "%$key%")
                    ->orWhere('url', "LIKE", "%$key%");
            })->paginate(10);
            $categories->appends("key", request()->key);
        }

        return view('seo_dashboard.pages.category_list', compact('categories'));
    }

    public function ctegories_set(Category $category)
    {
        return view('seo_dashboard.pages.category_seo', compact('category'));
    }

    public function ctegories_set_save(Category $category)
    {
        if ($category->url != request()->url) {
            $this->validate(request(), [
                'url' => ['unique:categories,url'],
            ]);
        }
        $category->fill(request()->all());
        $category->save();
        return redirect()->back();
    }

    public function products()
    {

        $categories = Product::paginate(10);
        if (request()->has("key")) {
            $key = request()->key;
            $categories = Product::where('product_name', $key)->orWhere(function ($q) use ($key) {
                return $q->where('product_name', "LIKE", "%$key%")
                    ->orWhere('product_url', "LIKE", "%$key%");
            })->paginate(10);
            $categories->appends("key", request()->key);
        }

        return view('seo_dashboard.pages.product_list', compact('categories'));
    }

    public function products_set(Product $data)
    {
        return view('seo_dashboard.pages.product_seo', compact('data'));
    }

    public function products_set_save(Product $data)
    {
        if ($data->product_url != request()->product_url) {
            $this->validate(request(), [
                'product_url' => ['unique:products,product_url'],
            ]);
        }
        $data->fill(request()->except("related_image"));
        $data->save();
        foreach (request()->related_image as $key => $alt) {
            ProductImage::where('id',$key)->update([
                'alt' => $alt,
            ]);
        }
        return redirect()->back();
    }

    public function tags()
    {

        $data = Tag::orderBy('id','desc')->paginate(10);
        if (request()->has("key")) {
            $key = request()->key;
            $data = Tag::where('title', $key)->orWhere(function ($q) use ($key) {
                return $q->where('title', "LIKE", "%$key%")
                    ->orWhere('url', "LIKE", "%$key%");
            })->orderBy('id','desc')->paginate(10);
            $data->appends("key", request()->key);
        }

        return view('seo_dashboard.pages.tag_list', compact('data'));
    }

    public function tags_set(Tag $data)
    {
        return view('seo_dashboard.pages.tag_seo', compact('data'));
    }

    public function tags_set_save(Tag $data)
    {
        if ($data->url != request()->url) {
            $this->validate(request(), [
                'url' => ['unique:tags,url'],
            ]);
        }
        $data->fill(request()->all());
        $data->save();
        return redirect()->back();
    }

    public function tags_create()
    {
        return view('seo_dashboard.pages.tag_create');
    }

    public function tags_store()
    {
        $this->validate(request(),[
            "title" => ['required'],
            "url" => ['required','unique:tags,url'],
            "seo_title" => ['required'],
            "seo_description" => ['required'],
            "seo_keywords" => ['required'],
        ]);

        Tag::create(request()->all());
        return redirect()->route('seo_tags');
    }
}

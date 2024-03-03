<?php

namespace App\Providers;

use App\Http\View\Composers;
use App\Http\View\Composers\MetaComposer;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.frontend_master', function ($view) {

            $category_meta = Category::get('meta_title', 'meta_description');
            $product_meta = Product::get('meta_title','meta_description');
            $view->with('meta', $category_meta,$product_meta);
            // dd($meta);
        });
    }
}

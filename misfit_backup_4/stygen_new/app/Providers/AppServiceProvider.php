<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\MetaComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // View::composer(
        //     'frontend.frontend_master', 'App\Http\Composers\MetaComposer'
        // );


        // $products = \Cache::rememberForever('all-products', function () {
        //     return \App\Models\Product::all();
        // });
    }
}

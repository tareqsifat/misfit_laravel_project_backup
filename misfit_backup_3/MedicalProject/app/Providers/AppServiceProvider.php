<?php

namespace App\Providers;

use App\Models\Footer;
use App\Models\Notification;
use Illuminate\Pagination\Paginator;
// use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $footer = Footer::first();
        $notification = Notification::where('notification', 0)->get();
        // $authuser = Auth::user() ;
        View::share(['footer' => $footer]);
        View::share(['notification' => $notification]);
        // View::share(['authuser' => $authuser]);

        // dd($authuser);

        // Paginator::useBootstrap();

    }
}

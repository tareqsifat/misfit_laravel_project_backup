<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Content;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

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
        if (!App::runningInConsole()) {
            $content =  Content::find(1)->first();
            view()->share('content', $content);


            $services = Service::orderBy('ranking', 'ASC')->where('status', '1')->get();
            view()->share('services', $services);

            $blogs = Blog::orderBy('id', 'DESC')->get();
            view()->share('blogs', $blogs);
            $testimonials = Testimonial::orderBy('id', 'DESC')->get();
            view()->share('testimonials', $testimonials);

            //  $destinations = Destination::orderBy('ranking', 'ASC')->where('status', '1')->get();
            //  view()->share('destinations', $destinations);


            //  $packages = Package::orderBy('ranking', 'ASC')->where('status', '1')->get();
            //  view()->share('packages', $packages);
        }
        // $content =  Content::find(1)->first();
        // view()->share('content', $content);


        // $services = Service::orderBy('ranking', 'ASC')->where('status', '1')->get();
        // view()->share('services', $services);

        // $blogs = Blog::orderBy('id', 'DESC')->get();
        // view()->share('blogs', $blogs);
        // $testimonials = Testimonial::orderBy('id', 'DESC')->get();
        // view()->share('testimonials', $testimonials);

        // //  $destinations = Destination::orderBy('ranking', 'ASC')->where('status', '1')->get();
        // //  view()->share('destinations', $destinations);


        // //  $packages = Package::orderBy('ranking', 'ASC')->where('status', '1')->get();
        // //  view()->share('packages', $packages);

    }
}

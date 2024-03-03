<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Availability;
use App\Models\Blog;
use App\Models\Content;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\Hero;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{


    public function mail()
    {
        $user = User::find(2); // Assuming you have a User model

        Mail::to($user->email)->send(new WelcomeMail($user));

        return 'Welcome email sent!';
    }

    public function index()
    {
        $now = Carbon::now();

        $avaibilities  = Availability::where('date', '>', $now->toDateString())
            ->orWhere(function ($query) use ($now) {
                $query->where('date', $now->toDateString())
                    ->where('time', '>', $now->toTimeString());
            })
            ->get();
        $locations = Location::where('status', '1')->get();
        $doctors = Doctor::all();

        $content = Content::find(1);
        // $service s= $service->packages;
        // dd($service)s;
        // dd($blogs);
        $heros = Hero::all();
        $faqs = Faq::where('status', '1')->orderBy('id', 'DESC')->get();
        return view('web.pages.index', compact('locations', 'avaibilities', 'heros', 'faqs','doctors'));
    }




    public function dashboard()
    {
        if (Auth::user()->role == 1) {
            return redirect()->route('profile.index');
        } else {
            return view('admin.pages.index');
        }
    }

    public function blogs()
    {
        // dd($title);
        $blogs = Blog::where('status', '1')->orderBy('id', 'DESC')->get();
        //  dd($blog);
        return view('web.pages.blogs.index', compact('blogs'));
    }

    public function blogDetails($title)
    {
        $blogs = Blog::where('status', '1')->orderBy('id', 'DESC')->get();
        // dd($title);
        $blog = Blog::where('title', $title)->first();
        // dd($blog);
        $content = Content::find(1);
        // dd($blogs);

        return view('web.pages.blogs.details', compact('blog', 'blogs', 'content'));
    }

    public function contact()
    {
        return view('web.pages.contact');
    }
}

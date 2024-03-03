<?php

namespace App\Http\Controllers;

use App\Models\AppointPage;
use App\Models\AppointQue;
use App\Models\Blog;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\Footer;
use App\Models\OpeningHour;
use App\Models\OurWork;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Testimonial;
use PhpParser\Node\Expr\Cast\String_;

class WebsiteController extends Controller
{
    public function index()
    {
        $slider = Slider::get();
        $service = Service::latest()->get();
        $faqs = Faq::latest()->get();
        $testimonial =Testimonial::latest()->get();
        $doctor = Doctor::latest()->get();
        // $footer = Footer::latest()->get();
        return view('website.index', compact('slider','service', 'faqs','testimonial', 'doctor'));
    }

    public function aboutUs()
    {
        // $footer = Footer::latest()->get();
        $service = Service::latest()->get();
        $ourwork = OurWork::latest()->get();
        $doctor = Doctor::latest()->get();
        $opening = OpeningHour::get();
        return view('website.about',compact('service','ourwork', 'opening','doctor'));
    }

    public function department()
    {
        // $footer = Footer::latest()->get();
        $department = Department::where('status',1)->with('doctor_info')->with('treatment_info')->get();
        return view('website.department', compact('department'));
    }

    public function appointment()
    {
        // $footer = Footer::latest()->get();
        $appoint_que = AppointQue::latest()->get();
        $appoint_page = AppointPage::where('published',1)->first();
        // dd($appoint_page);
        return view('website.appointment', compact('appoint_que','appoint_page'));
    }

    public function doctor()
    {
        // $footer = Footer::latest()->get();
        $doctor = Doctor::latest()->get();
        return view('website.doctor', compact( 'doctor'));
    }
    public function doctorList()
    {
        $doctor = Doctor::latest()->get();
        // $footer = Footer::latest()->get();
        return view('website.doctor_list', compact('doctor'));
    }


    public function singleDoctor($slug)
    {
        $doctor = Doctor::where('slug', $slug)->first();
        return view('website.single_doctor', compact('doctor'));
    }
    
    public function blog()
    {
        $blog = Blog::get();
        return view('website.blog', compact('blog'));
    }

    public function blogShow($slug)
    {
        $blogs = Blog::where('slug', $slug)->with(['user_info','category_info','subcategory_info'])->first();
        $count = $blogs->comments->count() + $blogs->reply->count();
        function finder(String $findby, String $value){
            return Blog::where($findby, $value)->get();
        }

        $related_post = finder('category_id', $blogs->category_id);
        $prev_post = finder('id', $blogs->id-1);
        $next_post = finder('id', $blogs->id+1);
        return view('website.blog_post', compact('blogs', 'count','related_post','prev_post', 'next_post'));
    }
    public function contact()
    {
        $opening = OpeningHour::get();
        return view('website.contact', compact('opening')); 
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Events\SendContactEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Blog;
use App\Models\CompanyProfile\Company;
use App\Models\Job\JobPost;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class WebPageController extends Controller
{
    public function home()
    {
        # get the active and is_top companies from database

        $companies = Company::active()->where('is_top', 1)->get();
        $job_posts = JobPost::active()->with(['company', 'job_type'])->get();
        $blogs = Blog::paginate(10);
        return view('web.home',[
            'companies' => $companies,
            'job_posts' => $job_posts,
            'blogs' => $blogs
        ]);
    }

    public function jobs()
    {
        $job_posts = JobPost::active()->with(['company', 'job_type'])->get();
        return view('web.jobs', compact('job_posts'));
    }

    public function job_details($id) : View 
    {
        $job = JobPost::find($id);
        $job->load('company');
        $job->load('job_type');

        return view('web.job_details', compact('job'));
    }

    public function company()
    {
        $companies = Company::active()->with('job_post')->paginate(10);
        return view('web.company', compact('companies'));
    }

    public function company_details($id)
    {
        $company = Company::find($id);
        return view('web.company_details', compact('company'));
    }

    public function pages()
    {
        return view('web.pages');
    }

    public function blogs()
    {
        $blogs = Blog::paginate(10);
        return view('web.blogs', compact('blogs'));
    }

    public function blog_details($id)
    {
        $blog = Blog::find($id);
        return view('web.blog_details', compact('blog'));
    }

    public function contact()
    {
        return view('web.contact_us');
    }

    public function sendContactEmail(ContactRequest $request)
    {
        try {
            $name = $request->con_name;
            $email = $request->con_email;
            $message = $request->con_message;

            event(new SendContactEmailEvent($name, $email, $message));

            return redirect('/contact');
        } catch (Exception $e) {
            Log::error($e);
            // return $this->error($e->getMessage(), $e->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

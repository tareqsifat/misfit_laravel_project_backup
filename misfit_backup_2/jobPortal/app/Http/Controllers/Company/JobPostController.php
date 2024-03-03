<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Models\CompanyProfile\Company;
use App\Models\CompanyProfile\Employer;
use App\Models\Job\JobPost;
use App\Models\Job\JobType;
use App\Services\JobPostService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job_posts = JobPost::active()->where('company_id', $this->company()->id)->paginate(10);

        return view('company.job_post.index', compact('job_posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $job_types = JobType::all();
        return view('company.job_post.create', compact('job_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostRequest $request)
    {
        $job_posts = new JobPost();
        $job_posts->posted_by_id = 1;
        $job_posts->company_id = $this->company()->id;
        $job_posts->created_date = Carbon::now()->toDateTimeString();

        $data['job_type_id'] = $request->job_type_id;
        $data['created_date'] = $request->created_date;
        $data['deadline'] = $request->deadline;
        $data['job_title'] = $request->job_title;
        $data['vacancy'] = $request->vacancy;
        $data['job_salary'] = $request->job_salary;
        $data['job_location'] = $request->job_location;
        $data['job_description'] = $request->job_description;

        $job_post_service = new JobPostService();
        $job_post_service->save($job_posts, $data);

        return redirect()->route('company.job_post.index');
    }

    public function show($id)
    {
        $job_post = JobPost::active()->with('job_type')->find($id);
        if(!$job_post){
            return redirect()->back()->with('error', 'job_post not found');
        }
        return view('company.job_post.show', compact('job_post'));
    }

    public function edit($id)
    {
        $job_types = JobType::get();
        $job_post = JobPost::active()->with('job_type')->find($id);
        if(!$job_post){
            return redirect()->back()->with('error', 'job_post not found');
        }

        return view('company.job_post.edit', compact('job_post', 'job_types'));
    }

    public function update(Request $request, $id)
    {
        $job_post = JobPost::active()->with('job_type')->find($id);
        if(!$job_post){
            return redirect()->back()->with('error', 'job_post not found');
        }

        $data['job_type_id'] = $request->job_type_id;
        $data['created_date'] = $request->created_date;
        $data['deadline'] = $request->deadline;
        $data['job_title'] = $request->job_title;
        $data['vacancy'] = $request->vacancy;
        $data['job_salary'] = $request->job_salary;
        $data['job_location'] = $request->job_location;
        $data['job_description'] = $request->job_description;

        $job_post_service = new JobPostService();
        $job_post_service->save($job_post, $data);

        return redirect()->route('company.job_post.index');
    }
    private function company()
    {
        $employer = Employer::find(Auth::guard('employer')->id());
        return $employer->company;
    }

    public function destroy($id)
    {
        $job_post = JobPost::active()->with('job_type')->find($id);
        if(!$job_post){
            return redirect()->back()->with('error', 'job_post not found');
        }

        $job_post->delete();
        return redirect()->back()->with('success', 'job_post deleted successfully');
    }
}

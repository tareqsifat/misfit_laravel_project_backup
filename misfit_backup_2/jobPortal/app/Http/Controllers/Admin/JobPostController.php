<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Models\CompanyProfile\Company;
use App\Models\Job\JobPost;
use App\Models\Job\JobType;
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
        $job_posts = JobPost::active()->paginate(10);

        return view('admin.job_post.index', compact('job_posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $job_types = JobType::all();
        $companies = Company::all();
        return view('admin.job_post.create', compact('job_types','companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostRequest $request)
    {
        $job_posts = new JobPost();
        $job_posts->posted_by_id = 1;
        $job_posts->job_type_id = $request->job_type_id;
        $job_posts->company_id = $request->company_id;
        $job_posts->created_date = $request->created_date;
        $job_posts->deadline = $request->deadline;
        $job_posts->job_title = $request->job_title;
        $job_posts->created_date = Carbon::now()->toDateTimeString();
        $job_posts->vacancy = $request->vacancy;
        $job_posts->job_salary = $request->job_salary;
        $job_posts->job_location = $request->job_location;
        $job_posts->job_description = $request->job_description;
        $job_posts->save();

        return redirect()->route('job-posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

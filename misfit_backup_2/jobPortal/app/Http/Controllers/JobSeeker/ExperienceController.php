<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\job_seeker\ExperienceRequest;
use App\Models\CompanyProfile\Company;
use App\Models\SeekerProfile\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    public function index()
    {
        return redirect()->route('auth_user');
    }

    public function create()
    {
        $companies = Company::get();
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->take(10)->get();
        $cities = DB::table('cities')->take(10)->get();
        return view('web.job_seeker.experiences.create', compact('countries', 'states', 'cities','companies'));
    }

    public function store(ExperienceRequest $request)
    {

        Experience::create([
            'user_id' => auth()->id(),
            'is_current_job' => $request->input('is_current_job', 0),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'job_title' => $request->input('job_title'),
            'company_id' => $request->input('company_name'),
            'job_location_city' => $request->input('job_location_city'),
            'job_location_state' => $request->input('job_location_state'),
            'job_location_country' => $request->input('job_location_country'),
            'description' => $request->input('description')
        ]);
//        dd(345);
        return redirect()->route('auth_user')->with('success', 'Experience created successfully!');
    }

    public function edit($id)
    {
        $experience = $this->findExperienceOrFail($id);
        $companies = Company::get();
        $company = $experience->company;
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->take(10)->get();
        $cities = DB::table('cities')->take(10)->get();
        return view('web.job_seeker.experiences.create',
            compact('experience', 'countries', 'states', 'cities', 'company', 'companies'));
    }

    public function update(ExperienceRequest $request, $id)
    {
        $experience = $this->findExperienceOrFail($id);
        $experience->update($request->all());

        return redirect()->route('auth_user')->with('success', 'Experience updated successfully!');
    }

    public function destroy($id)
    {
        $experience = $this->findExperienceOrFail($id);
        $experience->delete();

        return redirect()->route('auth_user')->with('success', 'Experience deleted successfully!');
    }

    private function findExperienceOrFail($id)
    {
        $experience = Experience::find($id);

        if (!$experience) {
            return redirect()->back()->with('error', 'Experience not found');
        }

        return $experience;
    }
}

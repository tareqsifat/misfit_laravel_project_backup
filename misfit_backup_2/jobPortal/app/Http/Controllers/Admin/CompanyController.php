<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::active()->paginate(10);
        return view('admin.company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required|string',
            'description' => 'required',
            'team_size' => 'string|nullable',
            'website' => 'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'establishment_date' => 'date|nullable',
            'website_link' => 'string|nullable',
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->location = $request->location;
        $company->description = $request->description;
        $company->team_size = $request->team_size;
        $company->establishment_date = $request->establishment_date;
        $company->company_website_url = $request->website_link;
        $company->is_top = $request->is_top_company;
        $company->save();

        #upload image
        if ($request->hasFile('image')) {
            // $file = $request->file('image');
            // $path = '/uploads/images/company-' . $company->name . '-' . $company->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            // $file->move(public_path('uploads/images'), $path);
            // $company->image = $path;`
            // $company->save();
            $company->image = Storage::put('uploads/company',$request->file('image'));
            $company->save();
        }

        return redirect()->route('company.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if($company->delete()){
            return redirect()->route('company.index')->with('success', 'Company deleted successfully');
        }else{
            return redirect()->route('company.index')->with('error', 'Company not deleted');
        }
    }
}

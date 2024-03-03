<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Department::where('status',1)->with(['doctor_info', 'treatment'])->get();
        // foreach ($collection as $value) {
        //     # code...
        //     dd($value);
        // }
        return view('admin.department.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'icon'=>'required',
            'doctor_id'=>'required',
            'title'=>'required|unique:departments,title',
            'description'=>'required'
        ]);

        $department = new Department();

        $department->icon = $request->icon;
        $department->doctor_id = $request->doctor_id;
        $department->service = $request->service; 
        $department->treatment_id = $request->treatment_id;
        $department->title = $request->title;
        $department->description = $request->description;
        $department->creator = Auth::user()->id;
        $department->slug = Str::slug(uniqid(10).$request->title);
        $department->save();

        session()->flash('alert-success','Department Added successfully');


        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Department::find($id);
        return view('admin.department.edit',compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'icon'=>'required',
            'title'=>'required',
            'description'=>'required'
        ]);

        $department = Department::find($id);

        $department->icon = $request->icon;
        $department->doctor_id = $request->doctor_id;
        $department->treatment_id = $request->treatment_id;
        $department->title = $request->title;
        $department->description = $request->description;
        $department->creator = Auth::user()->id;
        $department->slug = Str::slug(uniqid(10).$request->title);
        $department->save();

        session()->flash('alert-success','Department Updated successfully');


        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Department::find($id);
        $collection->delete();

        Session()->flash('alert-danger','Department deleted Successfully');

        return redirect()->route('departments.index');

    }
}

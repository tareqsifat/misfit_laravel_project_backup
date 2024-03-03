<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Treatment::latest()->get();
        return view('admin.treatment.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.treatment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:treatments,name',
            'cost' => 'required'
        ]);

        $treatment  = new Treatment();

        // $treatment->department_id = $request->department_id;
        $treatment->name = $request->name;
        $treatment->cost = $request->cost;
        $treatment->creator = Auth::user()->id;
        $treatment->slug = Str::slug(uniqid(5).'_'.$request->name);

        $treatment->save();

        session()->flash('alert-success', 'Treatment Added Successfully');

        return redirect()->route('treatment.index');
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
        $collection = Treatment::find($id);
        return view('admin.treatment.edit',compact('collection'));
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        $treatment  = Treatment::find($id);

        // $treatment->department_id = $request->department_id;
        $treatment->name = $request->name;
        $treatment->cost = $request->cost;
        $treatment->creator = Auth::user()->id;
        $treatment->slug = Str::slug(uniqid(5).'_'.$request->name);

        $treatment->save();

        session()->flash('alert-success', 'Treatment Updated Successfully');

        return redirect()->route('treatment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Treatment::find($id);
        $collection->delete();

        session()->flash('alert-danger', 'Treatment Deleated Successfully');

        return redirect()->route('treatment.index');
    }
}


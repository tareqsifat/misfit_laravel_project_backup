<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class unitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = unit::where('status',1)->latest()->paginate(10);
        return view('admin.Product.unit.index',compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Product.unit.create');
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
            'name' =>'required'
        ]);

        $unit = unit::create($request->all());

        $unit->slug = Str::slug($unit->name);
        $unit->creator = Auth::user()->id;
        $unit->save();

        return response()->json([
            'html' => "<option value='".$unit->id."'>".$unit->name."</option>",
            'value' => $unit->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(unit $unit)
    {
        return view('admin.Product.unit.edit',['unit'=> $unit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, unit $unit)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $unit->update($request->all());

        $unit->slug = Str::slug($unit->name);
        $unit->creator = Auth::user()->id;
        $unit->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = unit::find($id);
        $unit->delete();
        return response('success');
    }
}

<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class vendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = vendor::latest()->paginate(10);
        return view('admin.Product.vendor.index',compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Product.vendor.create');
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
            'name' =>['required'],
            'address' =>['required'],
            'email' =>['required'],
            'image' =>['required']
        ]);

        $vendor = vendor::create($request->except('image'));

        if($request->hasFile('image')){
            $vendor->image = Storage::put('uploads/vendors', $request->file('image'));
            $vendor->save();
        }

        $vendor->slug =Str::slug($vendor->name);
        $vendor->creator = Auth::user()->id;

        $vendor-> save();

        return response()->json([
            'html' => "<option value='".$vendor->id."'>".$vendor->name."</option>",
            'value' => $vendor->id,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(vendor $vendor)
    {
        return view('admin.Product.vendor.edit', ['vendor' => $vendor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vendor $vendor)
    {
        $this->validate($request,[
            'name' => ['required']
        ]);

        $vendor->update($request->except('icon'));
        if($request->hasFile('icon')){
            $vendor->icon = Storage::put('uploads/vendor', $request->file('icon'));
            $vendor->save();
        }

        $vendor->slug = str::slug($vendor->name);
        $vendor->creator = Auth::user()->id;
        $vendor-> save();

        // return 'success';
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
        $vendor = vendor::find($id);
        $vendor->delete();
        return response('success');
    }
}

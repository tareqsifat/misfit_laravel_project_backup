<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\MainCategory;
use App\Models\size;
use App\Models\status;
use Attribute;
use GrahamCampbell\ResultType\Success;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class sizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_categories = MainCategory::where('status',1)->get();

        $size = size::where('status',1)->latest()->paginate(10);
        return view('admin.product.size.index',compact('size'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Product.size.create');
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
            'name' => ['required'],
        ]);
        
        $size=size::create($request->except('icon'));

        

        $size->slug = Str::slug($size->name);
        $size->creator = Auth::user()->id;
        $size->save();
        
        return response()->json([
            'html' => "<option value='".$size->id."'>".$size->name."</option>",
            'value' => $size->id,
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
        $size = size::find($id);
        return view('admin.Product.brand.view',compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(size $size)
    {
        return view('admin.Product.size.edit',['size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, size $size)
    {
        $this->validate($request,[
            'name' => ['required']
        ]);

        $size->update($request->except('icon'));

        $size->slug = str::slug($size->name);
        $size->creator = Auth::user()->id;
        $size-> save();

        // return 'success';
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(size $size)
    {
        $size->delete();
        return response('success');
    }
}

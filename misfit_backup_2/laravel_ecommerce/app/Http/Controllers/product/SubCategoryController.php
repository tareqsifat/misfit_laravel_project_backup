<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_Category = SubCategory::where('status',1)->latest()->paginate();
        return view('admin.Product.subCategory.index',compact('sub_Category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_category = MainCategory::where('status',1)->latest()->get();
        $category = Category::where('status',1)->latest()->get();
        return view('admin.Product.subCategory.create',compact('main_category', 'category'));
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
            'name'=>['required'],
            'main_category_id'=> ['required'],
            'category_id'=>['required'],
            'icon'=> ['required']
        ]);
        $sub_Category = SubCategory::create($request->except('icon'));

        if($request->hasFile('icon')){
            $sub_Category->icon = Storage::put('uploads\category', $request->file('icon'));
            $sub_Category->save(); 
        }
        
        $sub_Category->creator = Auth::user()->id;
        $sub_Category->slug = Str::slug($sub_Category->name);
        $sub_Category->save();
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
    public function edit(SubCategory $sub_Category)
    {
        $main_category = MainCategory::where('status',1)->where('id', $sub_Category->main_category_id)->latest()->get();
        $category = Category::where('status',1)->where('main_category_id',$sub_Category->main_category_id)->latest()->get();
        return view('admin.Product.subCategory.edit',compact('main_category','category','sub_Category'));  
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $sub_Category)
    {
        $this->validate($request,[
            'name'=>['required'],
            'main_category_id' =>['required'],
            'category_id' => ['required']
        ]);

        // dd($sub_Category);
        if ($request->hasFile('icon')){
            $sub_Category->icon = Storage::put('uploads\category', $request->hasFile('icon'));
            $sub_Category->save();
        }
        
        $sub_Category->creator = Auth::user()->id;
        $sub_Category->Str::slug($sub_Category->name);
        $sub_Category->save();

        
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $sub_Category)
    {
        $sub_Category->delete();
        return response('success');
    }
}

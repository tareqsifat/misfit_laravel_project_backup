<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::where('status',1)->latest()->paginate();
        return view('admin.Product.Category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_category = MainCategory::where('status',1)->latest()->get();
        return view('admin.Product.Category.create',compact('main_category'));
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
            'main_category_id'=>['required'],
            'icon' => ['required']
        ]);

        $category = Category::create($request->except('icon'));

        if ($request->hasFile('icon')) {
            $category->icon = Storage::put('uploads/category', $request->file('icon'));
            $category->save();
        }

        $category->creator = Auth::user()->id;
        $category->slug = Str::slug($category->name);
        $category->save();
        return 'success';
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
    public function edit(Category $category)
    {
        $main_category = MainCategory::where('status',1)->latest()->get();
        return view('admin.Product.Category.edit',compact('category','main_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => ['required']
        ]);

        $category->update($request->except('icon'));
        if($request->hasFile('icon')){
            $category->icon = Storage::put('uploads/maincategory', $request->file('icon'));
            $category->save();
        }

        $category->slug = Str::slug($category->name);
        $category->creator = Auth::user()->id;
        $category->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response('success');
    }

    public function get_all_category_by_main_category($main_category_id)
    {
        $categories = Category::where('main_category_id', $main_category_id)->get();
        $option = "";  
        foreach ($categories as $key => $value) {
            $id = $value->id;
            $name = $value->name;
            $option.="<option value='$id'>$name</option>";
        }
        return $option;  
    }

    public function get_category_json()
    {
        $collection = Category::where('status',1)->latest()->get();
        $option = '';
        foreach ($collection as $key => $value) {
            $option .= "<option ".($key== 0?' selected':'')." value ='".$value->id."'>".$value->name."</option>";
        } 
        return $option;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = SubCategory::with('category_info')->paginate(10);
        // dd($collection);
        return view('admin.subCategory.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::latest()->get();
        return view('admin.subCategory.create',compact('category'));
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
            'name' => 'required',
        ]);


        $category = SubCategory::create(
            [
                'name' => $request->name,
            ]
        );

        $category->category_id = $request->category_id;
        $category->creator = Auth::user()->id;
        $category->slug = Str::slug($request->name);

        $category->save();

        return redirect()->route('subcategory.index');
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
        $category =Category::get();
        $collection = SubCategory::find($id);
        if ($collection) {

            return view('admin.subcategory.edit', compact('collection','category'));
        } else {
            return abort(404);
        }
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
            'name' => 'required|unique:sub_categories,name', $id,
        ]);

        // $category = Category::create([
        //     'name'=>$request->name,
        //     'icon' => Storage::put('uploads/category', $request->file('icon')),
        // ]);
        $category = SubCategory::find($id);
        if ($category) {
            $category->category_id = $request->category_id;
            $category->name = $request->name;
            $category->creator = Auth::user()->id;
            $category->slug = Str::slug($category->name);
            $category->save();

            return redirect()->route('subcategory.index');
        }
        else{
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = SubCategory::find($id);
        $category->delete();

        return back();
    }
}

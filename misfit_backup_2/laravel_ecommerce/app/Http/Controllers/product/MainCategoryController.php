<?php

namespace App\Http\Controllers\product;
 
use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_categories = MainCategory::where('status',1)->get();

        $mainCategory = MainCategory::where('status',1)->latest()->paginate(10);
        return view('admin.product.MainCategory.index',compact('mainCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Product.mainCategory.create');
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
            'icon' => ['required']
        ]);
        
        $mainCategory = MainCategory::create($request->except('icon'));

        if ($request->hasFile('icon')) {
            $mainCategory->icon = Storage::put('uploads/maincategory', $request->file('icon'));
            $mainCategory->save();
        }

        $mainCategory->slug = Str::slug($mainCategory->name);
        $mainCategory->creator = Auth::user()->id;
        
        $mainCategory->save();
        
        // return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainCategory = MainCategory::find($id);
        return view('admin.Product.mainCategory.view', compact('mainCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MainCategory $mainCategory)
    {
        return view('admin.Product.mainCategory.edit', ['mainCategory'=> $mainCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainCategory $mainCategory)
    {
        $this->validate($request,[
            'name' => ['required']
        ]);

        $mainCategory->update($request->except('icon'));
        if($request->hasFile('icon')){
            $mainCategory->icon = Storage::put('uploads/maincategory', $request->file('icon'));
            $mainCategory->save();
        }

        $mainCategory->slug = str::slug($mainCategory->name);
        $mainCategory->creator = Auth::user()->id;
        $mainCategory-> save();

        // return 'success';
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainCategory $main_category)
    {
        $main_category ->delete();
        return response('success');
    }
    
    public function get_main_category_json()
    {
        $collection = MainCategory::where('status',1)->latest()->get();
        $option = '';
        foreach ($collection as $key => $value) {
            $option .= "<option ".($key== 0?' selected':'')." value ='".$value->id."'>".$value->name."</option>";
        }
        return $option;
    }
}

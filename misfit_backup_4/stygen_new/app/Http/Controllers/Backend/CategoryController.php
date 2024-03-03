<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::where('status', 1)->orderBy('id','desc')->with('product_categories')->paginate(10);

        // return response()->json([
        //     'categories' => $categories
        // ], 200);

        $categories =  Category::where('status', 1)->orderBy('id','desc')->with('product_categories')->paginate(10);

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'category_name' => 'required',
        ]);

        $userId = Auth::guard('admin')->user()->id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $upload_path = public_path('assets/uploads/category');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);
        }else{
            $name = NULL;
        }

        if($request->hasFile('meta_image')){
            $meta_image = $request->file('meta_image');
            $upload_path = public_path('assets/uploads/category/meta');
            $meta_image_name = time() . '-' . $meta_image->getClientOriginalName();
            $meta_image->move($upload_path, $meta_image_name);
        }else{
            $meta_image_name = NULL;
        }

        if(isset($request->parent_id)){
            $parent_id = $request->parent_id;
        }else{
            $parent_id = 0;
        }
        $label = Category::where('id', $parent_id)->first();
        $check_category = Category::where('category_name', $request->category_name)->orWhere('id', $request->category_name)->first();

        if (isset($label)) {
            $cat_label = $label->label+1;
        }else{
            $cat_label = 0;
        }

        if($check_category){
            if (isset($label)) {
                $slug = $label->category_name.'-'.$request->category_name;
                $main_slug = Str::slug($slug);
            }
        }else{
            $main_slug = Str::slug($request->category_name);
        }

        $ex_category = Category::where('id', $request->category_name)->first();

        if(isset($ex_category)){
            $msg = 'error';
        }else{
            $category = Category::create([
                'company_id'            => 0,
                'parent_id'             => $parent_id,
                'label'                 => $cat_label,
                'category_name'         => $request->category_name,
                'cat_slug'              => $main_slug,
                'category_description'  => $request->category_description,
                'category_image'        => $name,
                'approve_category'      => $request->approve_category == 'true' ? 1:0,
                'meta_title'            => $request->meta_title,
                'meta_description'      => $request->meta_description,
                'meta_image'            => $meta_image_name,
                'status'                => 1,
                'created_by'            => $userId
            ]);
            $msg = 'Success';
        }

        return $msg;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $id = $request->id;
        $userId = Auth::guard('admin')->user()->id;
        $cat = Category::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $upload_path = public_path('assets/uploads/category');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);

            $existImage = public_path('assets/uploads/category/'.$cat->category_image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
        }else{
            $name = $cat->category_image;
        }

        if($request->hasFile('meta_image')){
            $meta_image = $request->file('meta_image');
            $upload_path = public_path('assets/uploads/category/meta');
            $meta_image_name = time() . '-' . $meta_image->getClientOriginalName();
            $meta_image->move($upload_path, $meta_image_name);

            $existMetaImage = public_path('assets/uploads/category/meta/'.$cat->meta_image);
            if(file_exists($existMetaImage)){
                @unlink($existMetaImage);
            }
        }else{
            $meta_image_name = $cat->meta_image;
        }

        $label = Category::where('id', $request->parent_id)->first();
        $check_category = Category::where('category_name', $request->category_name)->first();
        if (isset($label)) {
            $cat_label = $label->label+1;
        }else{
            $cat_label = 0;
        }

        if($check_category){
            if (isset($label)) {
                $slug = $label->category_name.'-'.$request->category_name;
                $main_slug = Str::slug($slug);
            }else{
                $main_slug = Str::slug($request->category_name);
            }
        }else{
            $main_slug = Str::slug($request->category_name);
        }

        $exCat = Category::where('category_name', $request->category_name)->orWhere('id', $request->category_name)->first();
        if(isset($exCat)){
            $category_name = $exCat->category_name;
        }else{
            $category_name = $request->category_name;
        }


        $category = Category::where('id', $id)->update([
            'parent_id'             => $request->parent_id,
            'label'                 => $cat_label,
            'category_name'         => $category_name,
            'cat_slug'              => $main_slug,
            'category_description'  => (!empty($request->category_description))?$request->category_description:NULL,
            'category_image'        => $name,
            'approve_category'      => $request->approve_category == 'true' ? 1:0,
            'meta_title'            => $request->meta_title,
            'meta_description'      => $request->meta_description,
            'meta_image'            => $meta_image_name,
            'status'                => 1,
            'updated_by'            => $userId
        ]);
        return 'Success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::guard('admin')->user()->id;
        $category = Category::find($id)->update(['deleted_by' => $userId, 'status' => 0]);
        Category::find($id)->delete();
        return $this->index();
    }

    //Multiple Category Delete
    public function multipleCategoryDelete(Request $request){
        $userId = Auth::guard('admin')->user()->id;
        foreach ($request->all()  as $category){
            Category::find($category['id'])->update(['deleted_by' => $userId, 'status' => 0]);
            Category::find($category['id'])->delete();
        }
        return 'Success';
    }

    //Categories List
    public function categoriesList(){
        $categories = Category::where('status', 1)->where('parent_id', 0)->orderBy('id','asc')->with('subcategory')->get();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    //Categories List for Create and Edit
    public function getAllCategories(){
        $get_all_categories = Category::where('status', 1)->orderBy('id','asc')->get();
        return response()->json([
            'get_all_categories' => $get_all_categories
        ], 200);
    }
}


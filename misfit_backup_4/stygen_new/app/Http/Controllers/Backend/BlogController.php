<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('status', 1)->orderBy('id','desc')->paginate(10);
        return response()->json([
            'blogs' => $blogs
        ], 200);
    }
    public function blog_product($id) {
        $product_sku = Product::where('id', $id)->pluck('blog_product_sku');
        $skus = json_decode($product_sku);
        foreach($skus as $sku) {
            $blog_product = Product::where('product_sku', $sku)->get();
        }
        return response()->json([
            'blog_product' => $blog_product
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

        // for separating the products from the description
        $description = $request->description;
        $description_check = Str::contains($description, '--');

        if($description_check == true) {
            $sku_get = explode('--' ,$description);
            $skus = [];
            foreach($sku_get as $sku) {
                $sku_check  = Str::contains($sku, 'ST');
                if($sku_check == true) {
                    array_push($skus, $sku);
                }
            }
        }

        $request->validate([
            'title'         => 'required',
            'image'         => 'required'
        ]);

        $userId = Auth::guard('admin')->user()->id;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $upload_path = public_path('assets/uploads/blog');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);
        }else{
            $name = NULL;
        }

        // dd($request->meta_description, $request->meta_title);
        $blog = Blog::create([
            'title'                 => $request->title,
            'blog_slug'             => Str::slug($request->title),
            'image'                 => $name,
            'description'           => $request->description,
            'meta_title'            => $request->meta_title,
            'meta_description'      => $request->meta_description,
            'blog_category'         => 0,
            'status'                => 1,
            'created_by'            => $userId
        ]);
        if(isset($skus)) {
            $blog->blog_product_sku = json_encode($skus);
        }
        return 'Success';
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
        $blog = Blog::find($id);
        return response()->json([
            'blog' => $blog
        ], 200);
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
        $id = $request->id;
        $userId = Auth::guard('admin')->user()->id;

        $blog_old = Blog::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $upload_path = public_path('assets/uploads/blog');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);

            $existImage = public_path('assets/uploads/blog/'.$blog_old->image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
        }else{
            $name = $blog_old->image;
        }

        $blog = Blog::where('id', $id)->update([
            'title'                 => $request->title,
            'blog_slug'             => Str::slug($request->title),
            'image'                 => $name,
            'description'           => $request->description,
            'meta_title'            => $request->meta_title,
            'meta_description'      => $request->meta_description,
            'blog_category'         => 0,
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
        $blog = Blog::find($id);
        $blog->update(['deleted_by' => $userId, 'status' => 0]);
        $existImage = public_path('assets/uploads/blog/'.$blog->image);
        if(file_exists($existImage)){
            @unlink($existImage);
        }
        Blog::find($id)->delete();
        return $this->index();
    }

    //Multiple Slider Delete
    public function multipleBlogDelete(Request $request){
        $userId = Auth::guard('admin')->user()->id;
        foreach ($request->all()  as $blog){
            $blog_old = Blog::find($blog['id']);
            $blog_old->update(['deleted_by' => $userId, 'status' => 0]);
            $existImage = public_path('assets/uploads/blog/'.$blog_old->image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
            Blog::find($blog['id'])->delete();
        }
        return 'Success';
    }
}

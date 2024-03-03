<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\BlogRequest;
use App\Models\Blog;
use App\Services\Admin\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::get();
        return view('admin.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data['title'] = $request->title;
            $data['sub_title'] = $request->sub_title;
            $data['description'] = $request->description;

            $blog = new Blog();

            $blog_service = new BlogService();
            $blog_service->save($data, $blog);

            //store image
            if ($request->hasFile('image')) {
                $blog->image = Storage::put('uploads/blog',$request->file('image'));
                $blog->save();
            }

            return redirect()->route('blog.index');
        }catch (\Throwable $e){
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request,$id)
    {
        try {
            $data['title'] = $request->title;
            $data['sub_title'] = $request->sub_title;
            $data['description'] = $request->description;

            $blog = Blog::find($id);

            $blog_service = new BlogService();
            $blog_service->save($data, $blog);

            //update image
            if($request->hasFile('image')){
                // dd(456);
                if(isset($blog->image) && file_exists(public_path().'/'.$blog->image)){
                    unlink(public_path().'/'.$blog->image);
                }
                $blog->image = Storage::put('uploads/blog',$request->file('image'));
                $blog->save();
            }

            return redirect()->route('blog.index');
        }catch (\Throwable $e){
            return redirect()->back()->with('error',$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('blog.index');
    }
}

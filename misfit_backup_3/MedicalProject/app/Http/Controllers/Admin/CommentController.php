<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Comment::latest()->paginate(10);
        return view('admin.comment.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->body){
            $comment = new Comment();
            if($request->hasFile('image')){
                $file = $request->file('image');
                $imagesfileName = $file->getClientOriginalName();
                $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
                $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
                
                $savename = $filename.'.'.$extension;
                $path = public_path("uploads/comments/$savename");
                Image::make($file)->resize(304,304)->save($path);
                
                // $savename->resize(306,306);
                
                $comment->image = $savename;
            }
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->website = $request->website;
            $comment->body = $request->body;
            $comment->blog_id = $request->blog_id;
            $comment->creator = Auth::user()->id;
            // dd($request->all());
            $comment->slug = Str::slug(uniqid().'_'.$request->body);
            $comment->save();

            session()->flash('alert-success','Your comment is saved and send to admin for approval');

            return back();
        }
        else{
            return back();
        }
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
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->approved = $request->approved;
        $comment->save();
        
        return redirect()->route('comments.index');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Comment::find($id);
        $collection->delete();

        session()->flash('alert-danger','comment deleted Successfully');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;


class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Reply::latest()->get();
        // dd($collection->reply);
        return view('admin.reply.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.reply.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->body){
            $reply = new Reply();
            if($request->hasFile('image')){
                $file = $request->file('image');
                $imagesfileName = $file->getClientOriginalName();
                $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
                $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
                
                $savename = $filename.'.'.$extension;
                $path = public_path("uploads/replies/$savename");
                Image::make($file)->resize(304,304)->save($path);
                
                // $savename->resize(306,306);
                
                $reply->image = $savename;
            }
            $reply->name = $request->name;
            $reply->email = $request->email;
            $reply->website = $request->website;
            $reply->body = $request->body;
            $reply->blog_id = $request->blog_id;
            $reply->comment_id = $request->comment_id;
            $reply->creator = Auth::user()->id;
            // dd($request->all());
            $reply->slug = Str::slug(uniqid().'_'.$request->body);
            $reply->save();

            // dd($request->all());
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
        $reply = reply::find($id);
        $reply->approved = $request->approved;
        $reply->save();
        
        return redirect()->route('reply.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Reply::find($id);
        $collection->delete();

        session()->flash('alert-danger','reply deleted Successfully');
        return back();
    }
}
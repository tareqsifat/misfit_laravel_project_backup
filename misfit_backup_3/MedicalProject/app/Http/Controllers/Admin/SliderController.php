<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Slider::get();
        return view('admin.slider.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'image' => 'required',
            'left_title' => 'required'
        ]);
        $slider = new Slider;
        if($request->hasFile('image')){
            $file = $request->file('image');
        $imagesfileName = $file->getClientOriginalName();
        $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
        $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
        
        $savename = $filename.'.'.$extension;
        $path = public_path("uploads/sliders/$savename");
        Image::make($file)->save($path);
        }
        
        $slider->image = $savename;

        $slider->left_title = $request->left_title;
        $slider->right_title = $request->right_title;
        $slider->description = $request->description;
        $slider->creator = Auth::user()->id;
        $slider->slug = Str::slug($request->left_title);
        $slider->save();

        return back();
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
        $collection = Slider::find($id);
        // dd($collection);
        return view('admin.slider.edit',compact('collection'));
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
        // dd($request->all());
        $this->validate($request, [
            'left_title' => 'required'
        ]);
        // Slider::where('id', $id)->update(['status'=> 0]);

        $slider = Slider::find($id);
        
        if($slider){
                if($request->hasFile('image')){
                $file = $request->file('image');
                $imagesfileName = $file->getClientOriginalName();
                $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
                $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
                
                $savename = $filename.'.'.$extension;
                $path = public_path("uploads/sliders/$savename");
                Image::make($file)->save($path);
                $slider->image = $savename;
            }
            

            $slider->left_title = $request->left_title;
            $slider->right_title = $request->right_title;
            $slider->description = $request->description;
            $slider->creator = Auth::user()->id;
            $slider->slug = Str::slug($request->left_title);
            $slider->save();

            return redirect()->back();
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
        $slider = Slider::find($id);
        $slider->delete();
        return back();
    }
}

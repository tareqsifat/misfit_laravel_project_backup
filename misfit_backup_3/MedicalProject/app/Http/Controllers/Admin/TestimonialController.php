<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Testimonial::paginate(10);
        return view('admin.testimonial.index', compact('collection'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
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
            'body' => 'required',
            'image' => 'required'
        ]);

        $testimonial = new Testimonial();

        if($request->hasFile('image')){
            $file = $request->file('image');
        $imagesfileName = $file->getClientOriginalName();
        $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
        $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
        
        $savename = $filename.'.'.$extension;
        $path = public_path("uploads/Testimonials/$savename");
        Image::make($file)->save($path);
        }
        
        $testimonial->image = $savename;

        $testimonial->body = $request->body;
        $testimonial->creator = Auth::user()->id;
        $testimonial->save();
        $testimonial->slug = Str::slug('patient Testimonial_'.$testimonial->id);
        $testimonial->save();
        
        session()->flash('alert-success', 'Testimonial Added Successfully');

        return redirect()->route('testimonial.index');
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
        $collection = Testimonial::find($id);
        return view('admin.testimonial.edit',compact('collection'));
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
            'body' => 'required'
        ]);

        $testimonial = testimonial::find($id);
        
        if($testimonial){
                if($request->hasFile('image')){
                $file = $request->file('image');
                $imagesfileName = $file->getClientOriginalName();
                $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
                $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
                
                $savename = $filename.'.'.$extension;
                $path = public_path("uploads/testimonials/$savename");
                Image::make($file)->save($path);
                $testimonial->image = $savename;
            }
            

            $testimonial->body = $request->body;
            $testimonial->creator = Auth::user()->id;
            $testimonial->slug = Str::slug($request->left_title);
            $testimonial->save();

            session()->flash('alert-success', 'Testimonial Updated Successfully');

            return redirect()->route('testimonial.index');
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
        $testimonial = Testimonial::find($id);
        $testimonial->delete();

        session()->flash('alert-danger', 'Testimonial Deleted Sussessfully');
        
        return back();

    }
}

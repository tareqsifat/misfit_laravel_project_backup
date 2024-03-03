<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// namespace Intervention\Image\Facades;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('id', 'DESC')->get();
        // dd($testimonials);
        return view('admin.pages.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(public_path());
        return view('admin.pages.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:2048', // max file size of 2MB
        ]);
        // dd($validatedData);
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();

        $img = Image::make($image->path());
        $img->fit(720, 530); // resize the image to fit within 380x310 while preserving aspect ratio
        $img->encode('jpg', 80); // convert image to JPEG format with 80% quality and reduce file size to 80kb
        $img->save(base_path('/uploads/testimonials/') . $imageName);

        $testimonial = new Testimonial();
        $testimonial->title = $validatedData['title'];
        $testimonial->subtitle = $validatedData['subtitle'];
        $testimonial->description = $validatedData['description'];
        $testimonial->image = $imageName;

        if ($testimonial->save()) {
            return redirect()
                ->route('testimonials.index')
                ->with('success', 'Testimonial created successfully.');
            # code...
        } else {
            return back()->with('error', 'Testimonial creating showing error.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.pages.testimonial.view', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.pages.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();

            $img = Image::make($image->path());
            $img->fit(380, 310); // resize the image to fit within 380x310 while preserving aspect ratio
            $img->encode('jpg', 80); // convert image to JPEG format with 80% quality and reduce file size to 80kb
            $img->save(base_path('/uploads/testimonials/') . $imageName);

            $testimonial->image = $imageName;
        }

        $testimonial->title = $validatedData['title'];
        $testimonial->subtitle = $validatedData['subtitle'];
        $testimonial->description = $validatedData['description'];
        $testimonial->save();

        return redirect()
            ->route('testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        // delete the testimonial's image file, if it exists

        if ($testimonial->image && file_exists(asset('uploads/testimonials/' . $testimonial->image))) {
            unlink(asset('uploads/testimonials/' . $testimonial->image));
        }

        // delete the testimonial from the database
        $testimonial->delete();

        return redirect()
            ->route('testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    /**
     * Active the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function Active(Testimonial $testimonial)
    {
        $testimonial->status = '1';
        if ($testimonial->save()) {
            return redirect()
                ->route('testimonials.index')
                ->with('success', 'testimonial Activated successfully.');
        } else {
            return back()->with('error', 'testimonial Activation Unsuccessfull');
        }
    }
    /**
     * Inactive  the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function Inactive(Testimonial $testimonial)
    {
        // dd($testimonial->status);
        $testimonial->status = '0';
        if ($testimonial->save()) {
            return redirect()
                ->route('testimonials.index')
                ->with('success', 'testimonial Deactivated successfully.');
        } else {
            return back()->with('error', 'testimonial Dactivation Unsuccessfull.');
        }
    }
}
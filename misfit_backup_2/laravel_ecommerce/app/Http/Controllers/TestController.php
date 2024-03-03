<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Intervention\Image\Facades\Image as Fimage;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->hasFile('fm_file')){

            $file = $request->file('fm_file');
            $extension = $file->getClientOriginalExtension();
            $temp_name = uniqid(10).time();

            $image = Fimage::make($file);
            // main Image
            $image->save('fm_image_main_'.$temp_name.'.'.$extension);

            // Rectecgle Image
            $image->fit(848,438, function($constraint){
                $constraint->aspectRatio();
            });
            $image->save('fm_image_848x438_'.$temp_name.'.'.$extension);
 
            // Squere Image
            $canvus = Fimage::canvas(400,400);
            $image->fit(400,400, function($constraint){
                $constraint->aspectRatio();
            });
            $canvus->insert($image);
            $canvus->insert(Fimage::make(public_path('icon.png')), 'center');
            $canvus->save('fm_image_400x400_'.$temp_name.'.'.$extension);
        }
        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Doctor::paginate(10);
        return view('admin.doctor.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor.create');
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
            'photo'=> 'required',
            'name'=> 'required',
            'designation'=> 'required',
            'description'=> 'string|max:200|nullable'
        ]);

        $doctor = new Doctor;


        // dd($request->all());
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $imagesfileName = $file->getClientOriginalName();
            $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
            $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
            
            $savename = $filename.'.'.$extension;
            $path = public_path("uploads/doctors/$savename");
            Image::make($file)->resize(304,304)->save($path);

            // $savename->resize(306,306);

            $doctor->photo = $savename;
        }

        $doctor->name = $request->name;
        $doctor->designation = $request->designation;
        $doctor->description = $request->description;
        $doctor->facebook_ac = $request->facebook_ac;
        $doctor->twitter_ac = $request->twitter_ac;
        $doctor->google_ac = $request->google_ac;
        $doctor->creator = Auth::user()->id;
        $doctor->slug = Str::slug($request->name);
        $doctor->save();

        session()->flash('alert-success','doctor Added successfully');
        
        return redirect()->route('doctors.index');
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
        $collection = Doctor::find($id);
        return view('admin.doctor.edit',compact('collection'));
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
        {
            $this->validate($request,[
                'name'=> 'required',
                'designation'=> 'required',
                'description'=> 'string|max:200|nullable',
            ]);
    
            $doctor = Doctor::find($id);
    
            if($request->hasFile('photo')){
                $file = $request->file('photo');
                $imagesfileName = $file->getClientOriginalName();
                $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
                $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
                
                $savename = $filename.'.'.$extension;
                $path = public_path("uploads/doctors/$savename");
                Image::make($file)->resize(304,304)->save($path);
    
                $doctor->photo = $savename;
            }


            $doctor->name = $request->name;
            $doctor->designation = Str::limit($request->designation,200);
            $doctor->description = $request->description;
            $doctor->facebook_ac = $request->facebook_ac;
            $doctor->twitter_ac = $request->twitter_ac;
            $doctor->google_ac = $request->google_ac;
            $doctor->creator = Auth::user()->id;
            $doctor->slug = Str::slug($request->name);
            $doctor->save();
    
            session()->flash('alert-success','Doctor Updated successfully');
            
            return redirect()->route('doctors.index');

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
        $doctor = Doctor::find($id);
        $doctor->delete();

        session()->flash('alert-danger','doctor Deleted successfully');
        
        return redirect()->route('doctors.index');
    }
}

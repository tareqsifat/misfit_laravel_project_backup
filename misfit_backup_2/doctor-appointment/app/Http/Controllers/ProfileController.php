<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        $appointments = Appointment::where('user_id', Auth::user()->id)->get();
        return view('web.pages.dashboard.index', compact('appointments'));
    }
    public function incomplete()
    {
        if (Auth::user()->complete == 0) {
            return view('web.pages.dashboard.incomplete');
        } else {
            return redirect()
                ->route('index')
                ->with('error', 'something error');
        }
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
        //  dd($request->all());
        $validatedData = $request->validate([
            'birthday' => 'required',
            'address' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'blood_group' => 'required',
            'gender' => 'required',
        ]);
        // dd($validatedData);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();

            $img = Image::make($image->path());
            $img->fit(380, 310); // resize the image to fit within 380x310 while preserving aspect ratio
            $img->encode('jpg', 80); // convert image to JPEG format with 80% quality and reduce file size to 80kb
            $img->save(public_path('uploads/patient/') . $imageName); // Save the image to public/uploads/patient

            $validatedData['image'] = $imageName;
        }
        $validatedData['user_id'] = Auth::user()->id;
        $user = User::find(Auth::user()->id);
        $user['complete'] = '1';
        if (Profile::create($validatedData)) {
            $user->update();
            return redirect()
                ->route('profile.index')
                ->with('success', 'Profile created successfully.');
            # code...
        } else {
            return back()->with('error', 'Profile creating showing error.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $profileData = $request->validate([
            'address' => 'required',
            'height' => 'required',
            'weight' => 'required',

        ]);
        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        // dd($validatedData);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();

            $img = Image::make($image->path());
            $img->fit(380, 310); // resize the image to fit within 380x310 while preserving aspect ratio
            $img->encode('jpg', 80); // convert image to JPEG format with 80% quality and reduce file size to 80kb
            $img->save(public_path('uploads/patient/') . $imageName); // Save the image to public/uploads/patient

            $profileData['image'] = $imageName;
        }
         $profile = Profile::where('user_id',Auth::user()->id)->first();
        $user = User::find(Auth::user()->id);
        $updateProfile = $profile->update($profileData);
        //  dd($profile);


        if ($updateProfile) {
            $user->update($userData);
            return redirect()
                ->route('profile.index')
                ->with('success', 'Profile Updated successfully.');
        } else {
            return back()->with('error', 'Profile Updating showing error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}

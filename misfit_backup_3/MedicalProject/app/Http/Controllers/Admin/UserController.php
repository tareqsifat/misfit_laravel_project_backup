<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = User::get();
        return view('admin.user.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'firstname' => ['required'],
            'lastname' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'designation' => ['required'],
            'photo' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 
        // dd($request->all());
        $user = new User();

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $imagesfileName = $file->getClientOriginalName();
            $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
            $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
            
            $savename = $filename.'.'.$extension;
            $path = public_path("uploads/users/$savename");
            Image::make($file)->save($path);

            $user->photo = $savename;
        }
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user -> username = $request -> username;
        $user -> designation = $request -> designation;
        $user -> description = $request -> description;
        $user -> email = $request -> email;
        $user -> password = Hash::make($request->password); 
        $user -> creator = Auth::user()->id;

        $user -> slug =  $request->firstname.uniqid(10);
        $user -> save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = User::find($id);
        return view('admin.user.show',compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $collection = User::find($id);
        // dd($collection->id);
        return view('admin.user.edit', compact('collection'));
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
        $this->validate($request,[ 
            'firstname' => ['required'],
            'lastname' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'designation' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 

        $user = User::find($id);

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $imagesfileName = $file->getClientOriginalName();
            $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
            $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
            
            $savename = $filename.'.'.$extension;
            $path = public_path("uploads/users/$savename");
            Image::make($file)->save($path);

            $user->photo = $savename;
        }
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->designation = $request->designation;
        $user->description = $request->description;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        $user->creator = Auth::user()->id;

        $user->slug =  $request->firstname.uniqid(10);
        $user -> save();

        return redirect()->route('user_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

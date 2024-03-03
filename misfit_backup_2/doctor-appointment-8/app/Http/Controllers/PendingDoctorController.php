<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class PendingDoctorController extends Controller
{
    public function index()
    {
        $doctors = User::where(['role'=> 2, 'activated' => 0])
                            ->orderBy('created_at', 'DESC')->get();
        return view('admin.pages.pending-doctor.index', compact('doctors'));
    }
    public function approveDoctor($id)
    {
        $doctor = User::find($id);
        if(isset($doctor) && $doctor->role == 2 && $doctor->activated == 0){
            $doctor->activated = 1;
            $doctor->save();

            \Illuminate\Support\Facades\Session::flash('success','Doctor Activated Successfully');

            return redirect()->back();
        }
        \Illuminate\Support\Facades\Session::flash('error','Doctor Not Found');

        return  redirect()->back();
    }

}

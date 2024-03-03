<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Appointment::latest()->paginate(10);
        // dd($collection->links()->paginator->onFirstPage());
        return view('admin.appointment.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.appointment.create');
    // }

    // public function topbar()
    // {
    //     $collection = Appointment::latest()->get();
    //     return view('admin.include.top_bar', compact('collection'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $this->validate($request,[
            'name' =>'required',
            'phone' =>'required',
            'dateOfBirth' => 'required',
            'appointmentDate' => 'required'
        ]);

        $appointment = new Appointment();

        $appointment->name = $request->name;
        $appointment->phone = $request->phone;
        $appointment->email = $request->email;
        $appointment->dateOfBirth = $request->dateOfBirth;
        $appointment->appointmentDate = $request->appointmentDate;
        $appointment->message = $request->message;
        $appointment->bookedbefore = $request->bookedbefore;
        $appointment->slug = Str::slug($request->name);
        $appointment->save(); 

        
        $nofication = new Notification();
        $nofication->message = "$appointment->name Added a new Appointment";
        $nofication->save();


        Session()->flash('alert-success', 'Appointment added successfully');

        return 'Your Appointment is added successfully';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointments)
    {
        // $collection = Appointment::find($id);
        $appointments->delete();
        return redirect()->back();
    }
}

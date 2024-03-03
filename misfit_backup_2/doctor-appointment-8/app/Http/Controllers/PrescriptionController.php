<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\MedicationRefillNotification;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->validate([
            'appointment_id' => 'required',
            'prescription' => 'required',
        ]);
        $user = User::find($request->input('patient_id'));
    
        $data['prescription'] = json_encode($data['prescription']);
        $appointment = Appointment::where('appointment_id', $data['appointment_id'])->first();

        if (Prescription::create($data)) {
            $appointment->status = '1';

            $appointment->update();

            $user = User::find($request->input('patient_id'));

            $user->notify( new MedicationRefillNotification("refilled"));


        return redirect()->route('appointment.index')->with('success','Prescribed Successfully');

        }else{
            return redirect()->back()->with('error','error');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        $data = $request->validate([
            'prescription' => 'required',
        ]);

        $data['prescription'] = json_encode($data['prescription']);

if ($prescription->update($data)) {
  return redirect()->route('appointment.index')->with('success','prescription updated Successfully');

}else{
    return redirect()->back()->with('error','error');

    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        //
    }
}

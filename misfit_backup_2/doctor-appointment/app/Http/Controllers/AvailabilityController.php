<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\Location;

class AvailabilityController extends Controller
{

    public function getAvailableDates(Request $request)
    {
        $locationId = $request->input('location_id');
    
        // Retrieve available dates based on the location ID
        $availableDates = Availability::where('location', $locationId)->get(['id', 'date']);
    
        return response()->json($availableDates);
    }
    /**
     * Display the availability calendar.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        $availabilities = Availability::all();

        return view('admin.pages.availability.index', compact('availabilities'));
    }

    /**
     * Show the form for creating a new availability.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations  = Location::all();
        return view('admin.pages.availability.create',compact('locations'));
    }

    /**
     * Store a newly created availability in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'time' => 'required',
            'date' => 'required|date',
        ]);

        Availability::create($request->all());

        return redirect()->route('availabilities.index')->with('success', 'Availability created successfully.');
    }

    /**
     * Show the form for editing the specified availability.
     *
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function edit(Availability $availability)
    {
        $locations  = Location::all();
        return view('admin.pages.availability.edit', compact('availability','locations'));
    }

    /**
     * Update the specified availability in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Availability $availability)
    {
        $request->validate([
            'location' => 'required',
            'time' => 'required',
            'date' => 'required|date',
        ]);

        $availability->update($request->all());

        return redirect()->route('availabilities.index')->with('success', 'Availability updated successfully.');
    }

    /**
     * Remove the specified availability from storage.
     *
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Availability $availability)
    {
        $availability->delete();

        return redirect()->route('availabilities.index')->with('success', 'Availability deleted successfully.');
    }


    public function Active(Availability $availability)
    {

        $availability->status = '1';
        if ($availability->save()) {
            return redirect()->route('availabilities.index')->with('success', 'availability Activated successfully.');
        } else {
            return back()->with('error', 'availability Activation Unsuccessfull');
        }
    }
    /**
     * Inactive  the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function Inactive(Availability $availability)

    {
        // dd($availability->status);
        $availability->status = '0';
        if ($availability->save()) {
            return redirect()->route('availabilities.index')->with('success', 'availability Deactivated successfully.');
        } else {
            return back()->with('error', 'availability Dactivation Unsuccessfull.');
        }
    }
}

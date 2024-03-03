<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.pages.location.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.pages.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',

        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    public function edit(Location $location)
    {
        return view('admin.pages.location.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {

        // $avaibilities = Availability::where('location' ,$location->id)->get();
        if($location->delete()){
            $location->availabilities()->delete();
            return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
        }
       

        
    }

    public function Active(Location $location)
    {
        $location->status = '1';
        if ($location->save()) {
            return redirect()
                ->route('locations.index')
                ->with('success', 'location Activated successfully.');
        } else {
            return back()->with('error', 'location Activation Unsuccessfull');
        }
    }
    /**
     * Inactive  the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function Inactive(Location $location)
    {
        // dd($location->status);
        $location->status = '0';
        if ($location->save()) {
            return redirect()
                ->route('locations.index')
                ->with('success', 'location Deactivated successfully.');
        } else {
            return back()->with('error', 'location Dactivation Unsuccessfull.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpeningHour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OpeningHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = OpeningHour::latest()->get();
        return view('admin.opening_hour.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.opening_hour.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'day' =>'required|unique:opening_hours,day',
        //     'isclosed' => 'required'
        // ]);

        // if ($request->isclosed == 0) {
        //     $this->validate($request,[
        //         'start_time' =>'required',
        //         'end_time' =>'required'
        //     ]);
        // }

        // $opening = new OpeningHour();

        // $opening->day = $request->day;

        // if ($request->isclosed == 0) {
        //     if ($request->isclosed == 0) {
        //         $opening->start_time = $request->start_time;
        //         $opening->end_time = $request->end_time;  
        //     }
        //     else{
        //         $opening->start_time = null;
        //         $opening->end_time = null;
        //     }
        // }
        // else{
        //     $opening->start_time = null;
        //     $opening->end_time = null;
        // }
        // $opening->isclosed = $request->isclosed;
        
        // // dd($request->all());
        // $opening->creator = Auth::user()->id;
        // $opening->slug = Str::slug($request->day);
        // $opening->save();

        // session()->flash('alert-success', 'Opening_Hour Added successfully');

        // return redirect()->route('opening_hour.index');
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
        $collection = OpeningHour::find($id);
        return view('admin.opening_hour.edit',compact('collection'));
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
        $this->validate($request, [
            'isclosed' => 'required'
        ]);
        if ($request->isclosed == 0) {
            $this->validate($request,[
                'start_time' =>'required',
                'end_time' =>'required'
            ]);
        }

        $opening =OpeningHour::find($id);

        if ($request->isclosed == 0) {
            $opening->start_time = $request->start_time;
            $opening->end_time = $request->end_time;  
        }
        else{
            $opening->start_time = null;
            $opening->end_time = null;
        }
        $opening->isclosed = $request->isclosed;
        
        $opening->creator = Auth::user()->id;
        $opening->slug = Str::slug($request->title);
        $opening->save();

        session()->flash('alert-success', 'Opening_hour updated successfully');

        return redirect()->route('opening_hour.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}

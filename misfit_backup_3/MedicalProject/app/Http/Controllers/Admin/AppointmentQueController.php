<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointQue;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AppointmentQueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = AppointQue::latest()->paginate(10);
        return view('admin.appoint_que.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.appoint_que.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' =>'required',
            'answer' => 'required'
        ]);

        $appoint_que = new AppointQue();

        $appoint_que->question = $request->question;
        $appoint_que->answer = $request->answer;
        
        $appoint_que->creator = Auth::user()->id;
        $appoint_que->slug = Str::slug($request->question);
        $appoint_que->save();

        $nofication = new Notification();
        $nofication->creator = Auth::user()->name;
        $nofication->save();
        $nofication->message = "$nofication->creator Added a new Appoint question";
        $nofication->save();

        session()->flash('alert-success', 'Question Added successfully');

        return redirect()->route('appoint_que.index');
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
        $collection = AppointQue::find($id);
        return view('admin.appoint_que.edit',compact('collection'));
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
            'answer' =>'required',
        ]);

        $appoint_que =AppointQue::find($id);

        $appoint_que->question = $request->question;
        $appoint_que->answer = $request->answer;
        
        $appoint_que->creator = Auth::user()->id;
        $appoint_que->slug = Str::slug($request->question);
        $appoint_que->save();

        session()->flash('alert-success', 'Question updated successfully');

        return redirect()->route('appoint_que.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = AppointQue::find($id);
        $collection->delete();

        session()->flash('alert-danger', 'Question Deleted successfully');

        return redirect()->route('appoint_que.index');
    }
}

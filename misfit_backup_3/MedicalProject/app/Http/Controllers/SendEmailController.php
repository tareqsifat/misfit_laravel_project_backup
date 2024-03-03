<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SendEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = SendEmail::latest()->paginate(10);
        return view('admin.send_email.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.send_email.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'phone'=>'required',
            'subject'=>'required',
            'message'=>'required'
        ]);

        $send_email =new SendEmail;

        $send_email->name = $request->name;
        $send_email->email = $request->email;
        $send_email->phone = $request->phone;
        $send_email->subject = $request->subject;
        $send_email->service = $request->service;
        $send_email->message = $request->message;
        $send_email->creator = Auth::user()->id;
        $send_email->slug = Str::slug($request->name);
        $send_email->save();

        $nofication = new Notification();
        $nofication->message = "$send_email->email is sent a message";
        $nofication->save();
        

        session()->flash('alert-success','Your message saved successfully');


        return 'Your message saved successfully';
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = SendEmail::find($id);
        $collection->delete();

        Session()->flash('alert-danger','message deleted Successfully');

        return back();
    }
}

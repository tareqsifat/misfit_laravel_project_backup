<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurWork;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class OurWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = OurWork::latest()->get();
        return view('admin.our_work.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.our_work.create');
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
            'icon'=>'required',
            'message'=>'required',
            'body'=>'required'
        ]);

        $our_work = new OurWork();

        $our_work->icon =$request->icon;
        $our_work->message = $request->message;
        $our_work->body = $request->body;
        $our_work->creator = Auth::user()->id;
        $our_work->slug = Str::slug($request->icon);
        $our_work->save();

        session()->flash('alert-success','our_work Added successfully');


        return redirect()->route('ourwork.index');
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
        $collection = OurWork::find($id);
        return view('admin.our_work.edit',compact('collection'));
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
            'body' => 'required',
        ]);

        $our_work = OurWork::find($id);

        if ($our_work) {
            $our_work->icon = $request->icon;
            $our_work->message = $request->message;
            $our_work->body = $request->body;
            $our_work->creator = Auth::user()->id;
            $our_work->slug = Str::slug($our_work->icon);
            $our_work->save();

            Session()->flash('alert-success','our_work updated Successfully');

            return redirect()->route('ourwork.index');

        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $our_work = OurWork::find($id);
        $our_work->delete();

        Session()->flash('alert-danger','our_work deleted Successfully');

        return redirect()->route('ourwork.index');

    }
}

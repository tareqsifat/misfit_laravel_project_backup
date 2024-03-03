<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Footer::get();
        return view('admin.footer.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.footer.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required_if:anotherfield,value',
    //         'facebook' => 'required',
    //         'phone' => 'required',
    //         'feed' => 'required',
    //     ]);

    //     $footer = new Footer();

    //     $footer->email = $request->email;
    //     $footer->facebook = $request->facebook;
    //     $footer->phone = $request->phone;
    //     $footer->feed = $request->feed;

    //     $footer->creator = Auth::user()->id;
    //     $footer->slug = Str::slug($request->email);

    //     $footer->save();

    //     Session()->flash('alert-success','footer Added Successfully');

    //     return redirect()->route('footer.index');
    // }

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
        $collection = Footer::find($id);
        return view('admin.footer.edit', compact('collection'));
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
            'email' => 'required',
            'facebook' => 'required',
            'phone' => 'required',
            'feed' => 'required',
        ]);


        $footer = Footer::find($id);
        // dd($request);

        $footer->email = $request->email;
        $footer->facebook = $request->facebook;
        $footer->phone = $request->phone;
        $footer->feed = $request->feed;
        $footer->company_name = $request->company_name;

        $footer->creator = Auth::user()->id;
        $footer->slug = Str::slug($request->email);

        $footer->save();

        Session()->flash('alert-success','footer Updated Successfully');

        return redirect()->route('footer.index');
    }

    public function singleupdate(Request $request, $id)
    {
        $footer = Footer::find($id);
        
        if ($request->has('company_name')) {
            $footer->update(array("company_name" => "$request->company_name"));
        }
        if ($request->has('email')) {
            $footer->update(array("email" => "$request->email"));
        }
        if ($request->has('facebook')) {
            $footer->update(array("facebook" => "$request->facebook"));
        }
        if ($request->has('phone')) {
            $footer->update(array("phone" => "$request->phone"));
        }
        if ($request->has('feed')) {
            $footer->update(array("feed" => "$request->feed"));
        }

        Session()->flash('alert-success','footer Updated Successfully');

        return redirect()->route('footer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $footer = Footer::find($id);
    //     $footer->delete();

    //     Session()->flash('alert-danger','footer deleted Successfully');

    //     return back();
    // }
}

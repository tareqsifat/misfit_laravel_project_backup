<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_categories = MainCategory::where('status',1)->get();

        $status = status::where('status',1)->latest()->paginate(10);
        return view('admin.Product.status.index',compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Product.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, status $status)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' =>['required']
        ]);

        $status = status::create($request->except('icon'));

        $status->slug = Str::slug($status->name);
        $status->creator = Auth::user()->id;
        $status->save();

        return 'success';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = status::find($id);
        return view('admin.Product.status.view', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(status $status)
    {
        return view('admin.Product.status.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,status $status)
    {
        $this->validate($request,[
            'name' => ['required']
        ]);

        $status->update($request->except('icon'));

        $status->slug = Str::slug($status->name);
        $status->creator = Auth::user()->id;
        $status->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(status $status)
    {
        $status->delete();
        return response('success');
    }
}

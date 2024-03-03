<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Faq::latest()->get();
        return view('admin.faqs.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
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
            'title' =>'required',
            'body' => 'required'
        ]);

        $faq = new Faq();

        $faq->title = $request->title;
        $faq->body = $request->body;
        
        $faq->creator = Auth::user()->id;
        $faq->slug = Str::slug($request->title);
        $faq->save();

        session()->flash('alert-success', 'Faq Added successfully');

        return redirect()->route('faqs.index');
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
        $collection = Faq::find($id);
        return view('admin.faqs.edit',compact('collection'));
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
            'title' =>'required',
        ]);

        $faq =Faq::find($id);

        $faq->title = $request->title;
        $faq->body = $request->body;
        
        $faq->creator = Auth::user()->id;
        $faq->slug = Str::slug($request->title);
        $faq->save();

        session()->flash('alert-success', 'Faq updated successfully');

        return redirect()->route('faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

        session()->flash('alert-danger', 'Faq deleted successfully');

        return redirect()->route('faqs.index');
    }
}

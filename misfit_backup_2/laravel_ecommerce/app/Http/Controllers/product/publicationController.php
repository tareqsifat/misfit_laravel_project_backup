<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class publicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publication = Publication::where('status',1)->latest()->paginate(10);
        return view('admin.product.Publication.index',compact('publication'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Product.Publication.create');
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
            'name' => ['required'],
            'description' => ['required'],
            'image' => ['required']
        ]);
        
        $publication = Publication::create($request->except('image'));

        if ($request->hasFile('image')) {
            $publication->image = Storage::put('uploads/publication', $request->file('image'));
            $publication->save();
        }

        $publication->slug = str::slug($publication->name);
        $publication->creator = Auth::user()->id;
        
        $publication->save();
        
        // return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publication = Publication::find($id);
        return view('admin.Product.Publication.view', compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        return view('admin.Product.Publication.edit', ['publication'=> $publication]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        $this->validate($request,[
            'name' => ['required'],
            'description' => ['required']
        ]);

        $publication->update($request->except('image'));
        if($request->hasFile('image')){
            $publication->image = Storage::put('uploads/Publication', $request->file('image'));
            $publication->save();
        }

        $publication->slug = str::slug($publication->name);
        $publication->creator = Auth::user()->id;
        $publication-> save();

        // return 'success';
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        $publication ->delete();
        return response('success');
    }
}

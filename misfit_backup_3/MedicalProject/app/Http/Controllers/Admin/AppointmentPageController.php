<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointPage;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class AppointmentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = AppointPage::get();
        // dd($collection->all());
        return view('admin.appoint_page.index',compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.appoint_page.create');
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
            'title_image' => 'required',
            'form_image' => 'required',
            'title_message' => 'required',
            'question_message' => 'required',
        ]);
        $appoint_page = new Appointpage();

        if($request->hasFile('title_image')){
            $file = $request->file('title_image');
            $imagesfileName = $file->getClientOriginalName();
            $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
            $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
            
            $savename = $filename.'.'.$extension;
            $path = public_path("uploads/appoint_pages/$savename");
            Image::make($file)->save($path);
            
            $appoint_page->title_image = $savename;
        }
        if($request->hasFile('form_image')){
            $file = $request->file('form_image');
            $imagesfileName = $file->getClientOriginalName();
            $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
            $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
            
            $savename = $filename.'.'.$extension;
            $path = public_path("uploads/appoint_pages/$savename");
            Image::make($file)->save($path);

            $appoint_page->form_image = $savename;
        }

        
        $appoint_page->title_message = $request->title_message;
        $appoint_page->question_message = $request->question_message;
        $appoint_page->creator = Auth::user()->id;
        $appoint_page->slug = Str::slug(substr($request->title_message, 10,50));
        $appoint_page->save();

        $nofication = new Notification();
        $nofication->creator = Auth::user()->name;
        $nofication->save();
        $nofication->message = "$nofication->creator Added a new Appoint Page Data";
        $nofication->save();


        return redirect()->route('appoint_page.index');
        session()->flash('alert-success',"Appoint Page Data Added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = AppointPage::find($id);
        return view('admin.appoint_page.edit', compact('collection'));
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
        $this->validate($request,[
            'title_message'=>'required',
            'question_message'=>'required',
        ]);

        $appoint_page = AppointPage::find($id);

        if($request->hasFile('title_image')){
            $file = $request->file('title_image');
            $imagesfileName = $file->getClientOriginalName();
            $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
            $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
            
            $savename = $filename.'.'.$extension;
            $path = public_path("uploads/appoint_pages/$savename");
            Image::make($file)->save($path);

            $appoint_page->title_image = $savename;
        }
        if($request->hasFile('form_image')){
            $file = $request->file('form_image');
            $imagesfileName = $file->getClientOriginalName();
            $filename = pathinfo($imagesfileName, PATHINFO_FILENAME);
            $extension = pathinfo($imagesfileName, PATHINFO_EXTENSION);
            
            $savename = $filename.'.'.$extension;
            $path = public_path("uploads/appoint_pages/$savename");
            Image::make($file)->save($path);

            $appoint_page->form_image = $savename;
        }

        $appoint_page->title_message = $request->title_message;
        $appoint_page->question_message = $request->question_message;

        $appoint_page->creator = Auth::user()->id;
        $appoint_page->slug = Str::slug(substr($request->title, 10));
        $appoint_page->save();

        
        $nofication = new Notification();

        $nofication->message = "Appoint Page Data updated successfully";

        session()->flash('alert-success','appoint_page updated successfully'); 

        return redirect()->route('appoint_page.index');
    }
    public function publish(Request $request, $id)
    {
        $publish = AppointPage::where('published',1)->update([
            'published' => 0
        ]);
        $appoint_page = AppointPage::find($id);

        
        $appoint_page->published = $request->published;
        $appoint_page->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = AppointPage::find($id);
        $collection->delete();

        session()->flash('alert-danger','Appoint Page Data deleted successfully');
        
        return redirect()->route('appoint_page.index');

    }
}

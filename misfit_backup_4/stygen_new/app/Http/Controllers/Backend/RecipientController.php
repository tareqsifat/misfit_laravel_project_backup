<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipients = Recipient::where('status', 1)->orderBy('id','desc')->paginate(10);
        return response()->json([
            'recipients' => $recipients
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipient_name'  => 'required',
            'recipient_image' => 'required'
        ]);

        if($request->hasFile('recipient_image')){
            $image = $request->file('recipient_image');
            $upload_path = public_path('assets/uploads/recipient');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);
        }else{
            $name = NULL;
        }

        $recipient = Recipient::create([
            'recipient_name'         => $request->recipient_name,
            'recipient_slug'         => Str::slug($request->recipient_name),
            'recipient_image'        => $name,
            'status'                => 1,
        ]);
        return 'Success';
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
    public function update(Request $request)
    {
        $id = $request->id;

        $recipient_old = Recipient::find($id);

        if($request->hasFile('recipient_image')){
            $image = $request->file('recipient_image');
            $upload_path = public_path('assets/uploads/recipient');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);

            $existImage = public_path('assets/uploads/recipient/'.$recipient_old->recipient_image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
        }else{
            $name = $recipient_old->recipient_image;
        }

        $recipient = Recipient::where('id', $id)->update([
            'recipient_name'         => $request->recipient_name,
            'recipient_slug'         => Str::slug($request->recipient_name),
            'recipient_image'        => $name,
            'status'                => 1,
        ]);
        return 'Success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipient = Recipient::find($id);
        $recipient->update(['status' => 0]);
        $existImage = public_path('assets/uploads/recipient/'.$recipient->recipient_image);
        if(file_exists($existImage)){
            @unlink($existImage);
        }
        Recipient::find($id)->delete();
        return $this->index();
    }

    //Multiple Recipient Delete
    public function multipleRecipientDelete(Request $request){
        foreach ($request->all()  as $recipient){
            $recipient_old = Recipient::find($recipient['id']);
            $recipient_old->update(['status' => 0]);
            $existImage = public_path('assets/uploads/recipient/'.$recipient_old->recipient_image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
            Recipient::find($recipient['id'])->delete();
        }
        return 'Success';
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Occasion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('id','desc')->paginate(10);
        return response()->json([
            'sliders' => $sliders
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
        if($request->show_single_product == 'true'){
            $request->validate([
                'image'         => 'required',
                'occasion_id'   => 'required'
            ]);
        }else{
            $request->validate([
                'image' => 'required'
            ]);
        }

        $userId = Auth::guard('admin')->user()->id;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $upload_path = public_path('assets/uploads/slider');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);
        }else{
            $name = NULL;
        }

        if($request->occasion_id == ''){
            $occasionId = NULL;
        }elseif($request->occasion_id == 'null'){
            $occasionId = NULL;
        }elseif($request->occasion_id == 0){
            $occasionId = NULL;
        }else{
            $occasionId = $request->occasion_id;
        }

        $slider = Slider::create([
            'title'                 => ($request->title != '')?$request->title:NULL,
            'image'                 => $name,
            'occasion_id'           => $occasionId,
            'show_home_page'        => ($request->show_home_page == 'true'?1:0),
            'show_single_product'   => ($request->show_single_product == 'true'?1:0),
            'status'                => 1,
            'created_by'            => $userId
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
        if($request->show_single_product == 'true'){
            $request->validate([
                'occasion_id'   => 'required'
            ]);
        }

        $id = $request->id;
        $userId = Auth::guard('admin')->user()->id;

        $slider_old = Slider::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $upload_path = public_path('assets/uploads/slider');
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move($upload_path, $name);

            $existImage = public_path('assets/uploads/slider/'.$slider_old->image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
        }else{
            $name = $slider_old->image;
        }

        if($request->occasion_id == ''){
            $occasionId = NULL;
        }elseif($request->occasion_id == 'null'){
            $occasionId = NULL;
        }elseif($request->occasion_id == 0){
            $occasionId = NULL;
        }else{
            $occasionId = $request->occasion_id;
        }

        $slider = Slider::where('id', $id)->update([
            'title'                 => ($request->title != 'null')?$request->title:NULL,
            'image'                 => $name,
            'occasion_id'           => $occasionId,
            'show_single_product'   => ($request->show_single_product == 'true'?1:0),
            'show_home_page'        => ($request->show_home_page == 'true'?1:0),
            'status'                => 1,
            'updated_by'            => $userId
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
        $userId = Auth::guard('admin')->user()->id;
        $slider = Slider::find($id);
        $slider->update(['deleted_by' => $userId, 'status' => 0]);
        $existImage = public_path('assets/uploads/slider/'.$slider->image);
        if(file_exists($existImage)){
            @unlink($existImage);
        }
        Slider::find($id)->delete();
        return $this->index();
    }

    //Multiple Slider Delete
    public function multipleSliderDelete(Request $request){
        $userId = Auth::guard('admin')->user()->id;
        foreach ($request->all()  as $slider){
            $slider = Slider::find($slider['id']);
            $slider->update(['deleted_by' => $userId, 'status' => 0]);
            $existImage = public_path('assets/uploads/slider/'.$slider->image);
            if(file_exists($existImage)){
                @unlink($existImage);
            }
            Slider::find($slider['id'])->delete();
        }
        return 'Success';
    }

    //Sliders For Landing Page
    public function getAllSlider(){
        $sliders = Slider::where('show_home_page', 1)->where('status', 1)->orderBy('id','asc')->with('occasion')->get();
        return response()->json([
            'sliders' => $sliders
        ], 200);
    }

    public function getSingleSlider(Request $request){
        $occasion_slug = $request->occasion_slug;
        $occasion = Occasion::where('occasion_slug', $occasion_slug)->first();
        $sliders = Slider::where('occasion_id', $occasion->id)->where('status', 1)->where('show_single_product', 1)->orderBy('id','desc')->with('occasion')->get();
        return response()->json([
            'sliders' => $sliders
        ], 200);
    }
}

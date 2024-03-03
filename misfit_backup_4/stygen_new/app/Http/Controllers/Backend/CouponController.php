<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::where('status', 1)->orderBy('id','desc')->with('users')->paginate(10);

        return response()->json([
            'coupons' => $coupons,
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
            'code'              => 'required',
            'start_date'        => 'required',
            'expire_date'       => 'required',
            'use_limit'         => 'required',
            'amount'            => 'required',
            'discount_type'     => 'required',
            'minimum_spent'     => 'required',
            'maximum_spent'     => 'required',
        ]);

        $coupon = Coupon::create([
            'category_id'       => 0,
            'title'             => $request->title,
            'code'              => $request->code,
            'start_date'        => $request->start_date,
            'expire_date'       => $request->expire_date,
            'use_limit'         => $request->use_limit,
            'amount'            => $request->amount,
            'description'       => $request->description,
            'discount_type'     => $request->discount_type,
            'minimum_spent'     => $request->minimum_spent,
            'maximum_spent'     => $request->maximum_spent,
            'status'            => 1
        ]);
        return response()->json('Success');
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
        $request->validate([
            'code'              => 'required',
            'start_date'        => 'required',
            'expire_date'       => 'required',
            'use_limit'         => 'required',
            'amount'            => 'required',
            'discount_type'     => 'required',
            'minimum_spent'     => 'required',
            'maximum_spent'     => 'required',
        ]);

        $coupon = Coupon::where('id', $id)->update([
            'category_id'       => 0,
            'title'             => $request->title,
            'code'              => $request->code,
            'start_date'        => $request->start_date,
            'expire_date'       => $request->expire_date,
            'use_limit'         => $request->use_limit,
            'amount'            => $request->amount,
            'description'       => $request->description,
            'discount_type'     => $request->discount_type,
            'minimum_spent'     => $request->minimum_spent,
            'maximum_spent'     => $request->maximum_spent,
            'status'            => 1
        ]);
        return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->update(['status' => 0]);
        Coupon::find($id)->delete();
        return $this->index();
    }

    //Multiple Coupon Delete
    public function multipleCouponDelete(Request $request){
        foreach ($request->all()  as $coupon){
            Coupon::find($coupon['id'])->update(['status' => 0]);
            Coupon::find($coupon['id'])->delete();
        }
        return response()->json('Success');
    }
}

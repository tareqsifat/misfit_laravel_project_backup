<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_charges = ShippingCharge::where('status', 1)->orderBy('id','desc')->paginate(10);
        return response()->json([
            'shipping_charges' => $shipping_charges
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
            'name'              => 'required',
            'shipping_charge'   => 'required'
        ]);

        $shipping_charge = ShippingCharge::create([
            'name'                  => $request->name,
            'shipping_charge'       => $request->shipping_charge,
            'status'                => 1
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required',
            'shipping_charge'   => 'required'
        ]);

        $shipping_charge = ShippingCharge::where('id', $id)->update([
            'name'                  => $request->name,
            'shipping_charge'       => $request->shipping_charge,
            'status'                => 1
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
        ShippingCharge::find($id)->update(['status' => 0]);
        ShippingCharge::find($id)->delete();
        return $this->index();
    }

    //Multiple Shipping Charge Delete
    public function multipleShippingChargeDelete(Request $request){
        foreach ($request->all()  as $shipping_charge){
            ShippingCharge::find($shipping_charge['id'])->update(['status' => 0]);
            ShippingCharge::find($shipping_charge['id'])->delete();
        }
        return 'Success';
    }
}

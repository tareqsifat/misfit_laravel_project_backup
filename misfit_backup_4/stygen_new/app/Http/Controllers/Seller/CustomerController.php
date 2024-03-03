<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyId = Auth::guard('seller')->user()->company_id;
        $customers = Customer::where('company_id', $companyId)->where('status', 1)->orderBy('id','desc')->paginate(10);
        return response()->json([
            'customers' => $customers
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
            'customer_name'  => 'required',
            'customer_phone' => 'required'
        ]);

        $companyId = Auth::guard('seller')->user()->company_id;
        $userId = Auth::guard('seller')->user()->id;
        $customer = Customer::create([
            'company_id'            => $companyId,
            'customer_name'         => $request->customer_name,
            'customer_email'        => $request->customer_email,
            'customer_phone'        => $request->customer_phone,
            'customer_address'      => $request->customer_address,
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name'  => 'required',
            'customer_phone' => 'required'
        ]);

        $userId = Auth::guard('seller')->user()->id;
        $customer = Customer::where('id', $id)->update([
            'customer_name'         => $request->customer_name,
            'customer_email'        => $request->customer_email,
            'customer_phone'        => $request->customer_phone,
            'customer_address'      => $request->customer_address,
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
        $userId = Auth::guard('seller')->user()->id;
        $customer = Customer::find($id)->update(['deleted_by' => $userId, 'status' => 0]);
        Customer::find($id)->delete();
        return $this->index();
    }

    //Multiple Customer Delete
    public function multipleCustomerDelete(Request $request){
        $userId = Auth::guard('seller')->user()->id;
        foreach ($request->all()  as $customer){
            Customer::find($customer['id'])->update(['deleted_by' => $userId, 'status' => 0]);
            Customer::find($customer['id'])->delete();
        }
        return 'Success';
    }
}

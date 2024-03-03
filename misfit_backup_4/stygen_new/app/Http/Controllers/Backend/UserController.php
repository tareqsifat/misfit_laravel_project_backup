<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Junior_project;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('backend.backend_master');
    }

    public function admin_details(){
        return response()->json([
            'admin'      => Auth::guard('admin')->user(),
        ], 200);
    }

    public function get_admin_details(){
        return response()->json(Auth::guard('admin')->user());
    }

    public function subscribeList()
    {
        $subscribes = Subscribe::where('status', 1)->paginate(10);
        return response()->json([
            'subscribes' => $subscribes
        ], 200);
    }
    public function juniorFormSubmit(Request $request)
    {
        $name = $request->name;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $remarks = $request->remarks;

        Junior_project::create([
            'name' => $name,
            'phone_number' => $phone_number,
            'address' => $address,
            'remarks' => $remarks
        ]);

        return 'success';
    }

    // public function getJuniorForm() {
    //     $junior_data = Junior_project::select('id', 'name', 'phone_number','address','remarks')->get();
    //     return response()->json([
    //         'junior_data' => $junior_data
    //     ], 200);
    // }
    public function campaign_user()
    {
        $user_data = User::select('id','name', 'email', 'phone','is_coupon')->where('status', 1)->orderBy('id','desc')->get();
        return response()->json([
            'user_data' => $user_data
        ], 200);
    }

    

    public function junior_project()
    {
        $junior_data = Junior_project::select('id', 'name', 'phone_number','address','remarks')->get();

        return response()->view('backend.junior_project', compact('junior_data'));
    }
}

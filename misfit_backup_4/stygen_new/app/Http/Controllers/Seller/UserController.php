<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('seller.seller_master');
    }

    public function seller_details(){
        return response()->json([
            'seller'      => Auth::guard('seller')->user(),
        ], 200);
    }

    public function get_seller_details(){
        return response()->json(Auth::guard('seller')->user());
    }

    //Seller Register
    public function sellerRegister(Request $request)
    {
        $sellerType = $request->seller_type;
        if($sellerType == 1){
            $request->validate([
                'seller_type'   => ['required', 'not_in:0'],
                'nid'           => ['required'],
                'name'          => ['required', 'string', 'max:255'],
                'email'         => ['required','string', 'email', 'max:255', 'unique:users'],
                'phone'         => ['required', 'string', 'unique:users'],
                'address'       => ['required', 'string'],
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }elseif($sellerType == 2){
            $request->validate([
                'seller_type'   => ['required', 'not_in:0'],
                'tin'           => ['required'],
                'bin'           => ['required'],
                'name'          => ['required', 'string', 'max:255'],
                'email'         => ['required','string', 'email', 'max:255', 'unique:users'],
                'phone'         => ['required', 'string', 'unique:users'],
                'address'       => ['required', 'string'],
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }else{
            $request->validate([
                'seller_type'   => ['required', 'not_in:0'],
                'name'          => ['required', 'string', 'max:255'],
                'email'         => ['required','string', 'email', 'max:255', 'unique:users'],
                'phone'         => ['required', 'string', 'unique:users'],
                'address'       => ['required', 'string'],
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        if($request->hasFile('nid')){
            $nid_image = $request->file('nid');
            $upload_path = public_path('assets/uploads/seller_doc');
            $nid_name = time() . '-' . $nid_image->getClientOriginalName();
            $nid_image->move($upload_path, $nid_name);
        }else{
            $nid_name = NULL;
        }

        if($request->hasFile('tin')){
            $tin_image = $request->file('tin');
            $upload_path = public_path('assets/uploads/seller_doc');
            $tin_name = time() . '-' . $tin_image->getClientOriginalName();
            $tin_image->move($upload_path, $tin_name);
        }else{
            $tin_name = NULL;
        }

        if($request->hasFile('bin')){
            $bin_image = $request->file('bin');
            $upload_path = public_path('assets/uploads/seller_doc');
            $bin_name = time() . '-' . $bin_image->getClientOriginalName();
            $bin_image->move($upload_path, $bin_name);
        }else{
            $bin_name = NULL;
        }

        $company = Company::create([
            'name'   => $request->name,
            'status' => 1
        ]);

        $username = explode(" ", $request->name);
        $seller = Seller::create([
            'company_id'    => $company->id,
            'seller_type'   => $request->seller_type,
            'name'          => $request->name,
            'username'      => $username[0],
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'password'      => Hash::make($request->password),
            'nid'           => $nid_name,
            'tin'           => $tin_name,
            'bin'           => $bin_name,
            'status'        => 0
        ]);

        return $seller;
    }
}

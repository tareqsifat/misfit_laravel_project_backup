<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use App\Models\Seller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $sellerType = $data['seller_type'];
        if($sellerType == 1){
            return Validator::make($data, [
                'seller_type'   => ['required', 'not_in:0'],
                'nid'           => ['required'],
                'name'          => ['required', 'string', 'max:255'],
                'email'         => ['required','string', 'email', 'max:255', 'unique:users'],
                'phone'         => ['required', 'string', 'unique:users'],
                'address'       => ['required', 'string'],
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }elseif($sellerType == 2){
            return Validator::make($data, [
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
            return Validator::make($data, [
                'seller_type'   => ['required', 'not_in:0'],
                'name'          => ['required', 'string', 'max:255'],
                'email'         => ['required','string', 'email', 'max:255', 'unique:users'],
                'phone'         => ['required', 'string', 'unique:users'],
                'address'       => ['required', 'string'],
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();

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
            'name'   => $data['name'],
            'status' => 1
        ]);

        $username = explode(" ", $data['name']);
        $seller = Seller::create([
            'company_id'    => $company->id,
            'seller_type'   => $data['seller_type'],
            'name'          => $data['name'],
            'username'      => $username[0],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'address'       => $data['address'],
            'password'      => Hash::make($data['password']),
            'nid'           => $nid_name,
            'tin'           => $tin_name,
            'bin'           => $bin_name,
            'status'        => 0
        ]);

        if($seller->phone == $data['phone']) {
            return 'phone number is already userd';
        }

        return $seller;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    // protected function guard()
    // {
    //     return Auth::guard('seller');
    // }
}

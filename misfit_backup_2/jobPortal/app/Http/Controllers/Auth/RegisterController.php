<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile\Company;
use App\Models\CompanyProfile\Employer;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserManagement\UserAccount;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:employer');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['role_id'] == 3){
            session()->put('role', 3);
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:user_accounts'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }else if($data['role_id'] == 2){
            session()->put('role', 2);
            return Validator::make($data, [
                'full_name' => ['required', 'string', 'max:255'],
                'nid_number' => ['required', 'string', 'max:255'],
                'tin_number' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        if($data['role_id'] == 3){
            $user = UserAccount::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            Auth::guard('user_account')->login($user);
        } elseif($data['role_id'] == 2){
            $user = Employer::create([
                'full_name' => $data['full_name'],
                'nid_number' => $data['nid_number'],
                'tin_number' => $data['tin_number'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            $company = Company::create([
                'name' => $data['company_name'],
                'email' => $data['company_email'],
                'registration_number' => $data['registration_number']
            ]);
            $user->company_id = $company->id;
            $user->save();
            Auth::guard('employer')->login($user);
            Session::put('guard', 'employer');
        }

        return $user;
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\AuthMail;
use App\Services\AccountValidationOtpService;
use App\Services\LoginServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }
    public function login(LoginRequest $request){


        $email = $request->get('email');
        $password = $request->get('password');
        $loginServices = new LoginServices();
        $service_login_status = $loginServices->login($email, $password);

        $message = "login failed!";
        if($service_login_status){
            $message = "login successful";

            return response()->json(["message" => $message],200);
        }
        return response()->json(["message" => $message],422);
    }

    public function register(RegisterRequest $request)
    {
        $data['name'] = $request->name ? $request->name : '';
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['user_type_id'] = $request->user_type_id;

        $loginServices = new LoginServices();
        $service_login_status = $loginServices->register($data);

        if(!$service_login_status){
            return response()->json(["message" => $service_login_status],401);
//            $message = "Register failed!";
        }
        $message = "Register successful";
        return response()->json([
            "message" => $message,
            "data" => Auth::guard('user_account')->user()
        ],200);
    }

    public function login_with_page(LoginRequest $request){

        $email = $request->get('email');
        $password = $request->get('password');
        $loginServices = new LoginServices();
        $service_login_status = $loginServices->login($email, $password);

        $message = "login failed! credentials does not match";
        if($service_login_status){
            $message = "login successful";

            Session::flash('message', "$message");
            return redirect()->route('welcome');
        }
        Session::flash('message', "$message");
        return redirect()->route('show-login-form');
    }

    public function send_auth_email(){
        $user= Auth::guard('user_account')->user();

        $otp = rand(111111, 999999);
        $otp_data['user_account_id'] = $user->id;
        $otp_data['otp'] = $otp;

        $otp_service = new AccountValidationOtpService();
        $otp = $otp_service->send_new_otp($otp_data);

        Mail::to($user->email)->send(new AuthMail($user->name, $user->email, $otp));

        return response()->json([
            "message" => "email sent successfully",
        ],200);
    }

    public function otp_verification(Request $request){
        $data['user_id'] = Auth::guard('user_account')->user()->id;
        $data['otp'] = $request->otp;

        $otp_validation_service = new AccountValidationOtpService();
        $otp_verified = $otp_validation_service->otp_verification($data);

        if($otp_verified){
            return response()->json([
                "message" => "otp verified successfully",
            ],200);
        }
        return response()->json([
            "message" => "Otp not found",
        ],400);

    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\AuthMail;
use App\Models\SeekerProfile\Address;
use App\Services\AccountValidationOtpService;
use App\Services\LoginServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
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

    public function logout():\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $guard = current_guard();
        Auth::guard($guard)->logout();

        return redirect('/');
    }
    public function auth_user(): \Illuminate\Contracts\View\View
    {
        $guard = current_guard();
        $user = Auth::guard($guard)->user();
        $addresses = Address::where('user_account_id', $user->id)->get();
        $experiences = $user->experience;

        return view('web.auth_user',compact('user', 'addresses', 'experiences'));
//        return view('web.auth_user',compact('user'));
    }

}

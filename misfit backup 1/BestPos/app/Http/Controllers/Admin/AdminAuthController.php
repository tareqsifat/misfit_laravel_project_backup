<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // if (Auth::guard('admin')->attempt($credentials)) {
        $admin = Admin::where('email', $request->email)->first();
        
        // dd($admin);
        if(Hash::check($request->password,$admin->password)){
            $token = $admin->createToken('BestPos')->accessToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'email or password is invalid'], 401);
        }
    }
    
    public function logout(Request $request)
    {
        // dd();
        if (Auth::guard('admin-api')->check()) {
            Auth::guard('admin-api')->user()->token()->revoke();
    
            return response()->json(['message' => 'Successfully logged out'], 200);
        } else {
            return response()->json(['error' => 'You are not logged in'], 401);
        }
    }
}

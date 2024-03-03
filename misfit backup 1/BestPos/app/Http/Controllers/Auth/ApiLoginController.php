<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiLoginController extends Controller
{

    public function auth_check($guard)
    {
        if (Auth::guard($guard)->check()) {
            return response()->json([
                "auth_status" => true,
                "auth_information" => Auth::guard($guard)->user(),
            ], 200);
        } else {
            return response()->json(0, 200);
        }
    }

    public function logout_from_all_devices(Request $request)
    {
        DB::table('oauth_access_tokens')->where('revoked', 0)->update([
            'revoked' => 1,
        ]);

        return response()->json(['message' => 'All active session has been closed'], 200);
    }

    public function user_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => ['required', 'max:256'],
            'full_name' => ['required', 'max:256'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $user = Admin::find(Auth::guard('admin-api')->user()->id);
        $user->user_name = $request->user_name;
        $user->full_name = $request->full_name;
        $user->update();

        return response()->json([
            'data' => $user,
            'message' => 'User updated successfully',
        ], 200);
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $new_password_confirmation = $request->new_password_confirmation;
        $user = Admin::find(Auth::guard('admin-api')->user()->id);
        if(!$user){
            return response()->json([
                'message' => 'user not found'
            ], 422);
        }

        if (strlen($old_password)) {
            if (Hash::check($old_password, $user->password)) {
                if (strlen($new_password) && strlen($new_password_confirmation)) {
                    $user->password = Hash::make($request->new_password);
                }
            } else {
                return response()->json([
                    'err_message' => 'validation error',
                    'data' => [
                        'old_password' => ['your given old password not matching'],
                    ],

                ], 422);
            }
        }

        $user->update();
        return response()->json([
            'message' => 'User password updated successfully',
        ], 200);
    }


    public function logout()
    {
        if(Auth::guard('admin-api')->check()){
            Auth::guard('admin-api')->user()->token()->revoke();
            return response()->json([
                'message' => 'logout',
            ], 200);
        }
        return response()->json([
            'message' => 'login user not found',
        ], 400);
    }
}

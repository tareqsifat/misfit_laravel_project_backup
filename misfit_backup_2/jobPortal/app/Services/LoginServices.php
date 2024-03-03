<?php

namespace App\Services;

use App\Models\AccountVerificationOtp;
use App\Models\User;
use App\Models\UserManagement\UserAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginServices
{
    //find user by email then try to login
    public function login($email, $password)
    {
        $user = UserAccount::where('email', $email)->first();

        if (isset($user) && Hash::check($password, $user->password)) {
            Auth::guard('user_account')->login($user);
            return $user;
        }
        else {
            return false;
        }
    }

    public function register($data){
        try {
            DB::beginTransaction();
            $user = new UserAccount();
            $user->name = $data['name'] ? $data['name'] : '';
            $user->email = $data['email'];
            $user->user_type_id = $data['user_type_id'];
            $user->password = Hash::make($data['password']);
            $user->save();

            DB::commit();
            Auth::guard('user_account')->login($user);
            return $user;
        }catch (\Exception $e){
            DB::rollBack();
            return $e;
        }
    }

}

<?php

namespace App\Services;

use App\Models\AccountVerificationOtp;
use App\Models\UserManagement\UserAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AccountValidationOtpService
{
    public function send_new_otp(array $data, bool $new = false){
        if($new){
            AccountVerificationOtp::where('user_account_id', $data['user_account_id'])->delete();
        }

        $otp = new AccountVerificationOtp();
        $otp->user_account_id = $data['user_account_id'];
        $otp->otp = $data['otp'];
        $otp->save();

        return $otp->otp;
    }

    public function otp_verification($data){
        $otp = AccountVerificationOtp::where([
            'user_account_id' => $data['user_id'],
            'otp' => $data['otp']
        ])->first();

        if(isset($otp)){
            $otp->delete();

            $userAccount = UserAccount::find($data['user_id']);
            $userAccount->update([
                'email_verified_at' => Carbon::now()->toDateTimeString()
            ]);
            return true;
        }
        return false;
    }
}
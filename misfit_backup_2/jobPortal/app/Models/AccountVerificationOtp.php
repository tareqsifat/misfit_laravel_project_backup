<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountVerificationOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_account_id',
        'otp'
    ];
}

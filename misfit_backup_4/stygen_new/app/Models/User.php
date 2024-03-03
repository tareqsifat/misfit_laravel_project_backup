<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'username',
        'email',
        'image',
        'phone',
        'gender',
        'is_coupon',
        'address',
        'password',
        'user_verified',
        'verified_code',
        'OTP',
        'status',
    ];

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function coupons()
    {
        return $this->hasMany(Coupon::class,'created_by', 'id');
    }

    public function UserOrder() {
        return $this->hasMany(User::class, 'phone', 'phone');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
        // $prefix = \URL::current();
        // if($prefix == 'http://localhost:8000/seller/password/email'){
        //     $this->notify(new \App\Notifications\SellerResetPasswordNotification($token));
        // }else{
        //     $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
        // }
    }
}

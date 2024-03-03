<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $guard = 'admin';

    protected $fillable = [
        'role_id',
        'full_name',
        'user_name',
        'email',
        'password',
        'is_active',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

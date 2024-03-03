<?php

namespace App\Models;

// app/Models/User.php

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // ... other model code ...

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',  // Assuming 'type' is used to determine user role
        'complete',
        'password',
    ];

    // ... other model code ...

    /**
     * Check if the user is a patient.
     *
     * @return bool
     */
    public function isPatient()
    {
        return $this->type === 'patient';
    }

    // ... other model code ...

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id','id');
    }
}


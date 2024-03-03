<?php

namespace App\Models\UserManagement;

use App\Models\SeekerProfile\Experience;
use App\Models\SeekerProfile\SkillSet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Authenticatable
{
    use HasFactory, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'user_account';

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function experience()
    {
        return $this->hasMany(Experience::class, 'user_id');
    }

    public function user_type() {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

//    public function skill_set()
//    {
//        return $this->hasMany(SkillSet::class, 'user_id', 'id');
//    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\SeekerProfile\Experience;
use App\Models\SeekerProfile\SkillSet;
use App\Models\UserManagement\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function skill_set()
    {
        return $this->hasMany(SkillSet::class, 'user_id', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\Institute\InstituteBranch;
use App\Models\UserManagement\Notification;
use App\Models\UserManagement\NotificationUser;
use App\Models\UserManagement\UserAttendence;
use App\Models\UserManagement\UserReview;
use App\Models\UserManagement\UserSalaryStatement;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'photo_url'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->slug = random_int(100,999).$user->id.random_int(1000,9999);
            $user->save();
        });
    }

    public function getPhotoUrlAttribute()
    {
        if (count(explode('http', $this->photo)) > 1) {
            return $this->photo;
        } else {
            return url('') . '/' . $this->photo;
        }
    }
    

    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'user_user_role', 'user_id', 'user_role_id', 'id', 'role_serial');
    }

    public function branch_admin()
    {
        return $this->hasMany(BranchAdmin::class, 'user_id');
    }

    public function branch_user()
    {
        return $this->belongsToMany(InstituteBranch::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(UserPermission::class, 'user_user_permission', 'user_id', 'user_permission_id', 'id', 'permission_serial'); //user::id
    }

    public function user_notification()
    {
        return $this->hasMany(NotificationUser::class, 'user_id', 'id');
    }

    public function salary_statements()
    {
        return $this->hasMany(UserSalaryStatement::class, 'user_id', 'id');
    }

    public function user_salary()
    {
        return $this->hasOne(UserSalary::class, 'user_id', 'id');
    }

    public function attendence()
    {
        return $this->hasMany(Attendence::class, 'table_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(UserReview::class, 'user_id');
    }
}

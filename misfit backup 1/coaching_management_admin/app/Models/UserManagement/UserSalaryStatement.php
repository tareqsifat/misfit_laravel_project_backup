<?php

namespace App\Models\UserManagement;

use App\Models\Institute\InstituteBranch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSalaryStatement extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function branch()
    {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }
}

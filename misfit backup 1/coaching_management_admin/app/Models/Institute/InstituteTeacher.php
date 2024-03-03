<?php

namespace App\Models\Institute;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteTeacher extends Model
{
    use HasFactory;

    public function branch()
    {
        return $this->belongsToMany(InstituteBranch::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function batch()
    {
        return $this->belongsToMany(InstituteClassBatch::class);
    }
}

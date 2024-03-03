<?php

namespace App\Models\Institute;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteStudent extends Model
{
    use HasFactory;

    public function institute_class_batches()
    {
        return $this->belongsToMany(InstituteClassBatch::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function branch()
    {
        return $this->belongsToMany(InstituteBranch::class);
    }

    public function payments()
    {
        return $this->hasMany(InstituteStudentPayment::class);
    }
}

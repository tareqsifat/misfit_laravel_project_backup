<?php

namespace App\Models\Institute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteClass extends Model
{
    use HasFactory;

    public function batch()
    {
        return $this->hasMany(InstituteClassBatch::class);
    }

    public function branch() {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(InstituteClassSubject::class);
    }

    public function time_schedule()
    {
        return $this->belongsToMany(InstituteClassBatchTimeSchedule::class);
    }
}

<?php

namespace App\Models\Institute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteClassSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function institute_class()
    {
        return $this->belongsToMany(InstituteClass::class);
    }

    public function batch() {
        return $this->belongsToMany(InstituteClassBatch::class);
    }

    public function branch() {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }

    public function time_schedule()
    {
        return $this->hasMany(InstituteClassBatchTimeSchedule::class, 'institute_class_subject_id', 'id');
    }
}

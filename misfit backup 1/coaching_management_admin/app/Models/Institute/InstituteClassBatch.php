<?php

namespace App\Models\Institute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteClassBatch extends Model
{
    use HasFactory;

    public function batch_teachers()
    {
        return $this->belongsToMany(InstituteTeacher::class);
    }

    public function class() {
        return $this->hasOne(InstituteClass::class, 'id', 'institute_class_id');
    }

    public function branch() {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }

    public function subjects() {
        return $this->belongsToMany(InstituteClassSubject::class);
    }

    public function exams()
    {
        return $this->hasMany(InstituteClassBatchExam::class);
    }

    public function time_schedule()
    {
        return $this->belongsToMany(InstituteClassBatchTimeSchedule::class);
    }

    public function institute_students()
    {
        return $this->belongsToMany(InstituteStudent::class);
    }
}

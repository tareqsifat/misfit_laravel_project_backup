<?php

namespace App\Models\Institute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteClassBatchTimeSchedule extends Model
{
    use HasFactory;


    public function batch()
    {
        return $this->hasOne(InstituteClassBatch::class, 'id', 'institute_class_batch_id');
    }

    public function branch()
    {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }

    public function class() {
        return $this->hasOne(InstituteClass::class, 'id', 'institute_class_id');
    }

    public function subject() {
        return $this->hasOne(InstituteClassSubject::class, 'id', 'institute_class_subject_id');
    }

    public function teacher() {
        return $this->hasOne(InstituteTeacher::class, 'id', 'institute_class_teacher_id');
    }
}

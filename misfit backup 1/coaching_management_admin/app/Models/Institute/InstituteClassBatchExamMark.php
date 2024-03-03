<?php

namespace App\Models\Institute;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteClassBatchExamMark extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function exam_batch()
    {
        return $this->hasOne(InstituteClassBatch::class, 'id', 'batch_id');
    }

    public function class()
    {
        return $this->hasOne(InstituteClass::class, 'batch_class_id', 'id');
    }

    public function exam()
    {
        return $this->hasOne(InstituteClassBatchExam::class, 'id', 'institute_class_batch_exam_id');
    }
}

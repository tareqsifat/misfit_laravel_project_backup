<?php

namespace App\Models\Institute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteClassBatchExam extends Model
{
    use HasFactory;
    protected $appends = [
        'total_student',
        'mark_given',
        // 'mark_not_given'
    ];

    public function getTotalStudentAttribute()
    {
        $batch_student = InstituteClassBatch::where('id', $this->institute_class_batch_id)
        ->with('institute_students')->first();
        
        return $batch_student->institute_students->count();
    }

    public function getMarkGivenAttribute()  {

        $batch_student = InstituteClassBatch::where('id', $this->institute_class_batch_id)
        ->with(['institute_students' => function ($q) {
            $q->select('user_id')->with('user');
        }])->first();
        $mark_given = 0;

        foreach ($batch_student->institute_students as $key => $student) {
            $mark = InstituteClassBatchExamMark::where('user_id', $student->user->id)
            ->where('batch_id', $this->institute_class_batch_id)
            ->where('institute_class_batch_exam_id', $this->id)
            ->count();

            $mark_given += $mark;
        }
        
        return $mark_given;
    }

    public function mark()
    {
        return $this->hasOne(InstituteClassBatchExamMark::class);
    }

    public function branch()
    {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }

    public function subject()
    {
        return $this->hasOne(InstituteClassSubject::class, 'id', 'subject_id');
    }
    
    public function batch()
    {
        return $this->hasOne(InstituteClassBatch::class, 'id', 'institute_class_batch_id');
    }
}

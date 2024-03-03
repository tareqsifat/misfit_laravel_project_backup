<?php

namespace App\Models\Institute;

use App\Models\Accounts\BranchAccountLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteStudentPayment extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(InstituteStudent::class, 'institute_student_id', 'id');
    }

   

    public function account_log() {
        return $this->hasOne(BranchAccountLog::class, 'id', 'account_log_id');
    }

    public function branch() {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }
}

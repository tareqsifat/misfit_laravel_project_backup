<?php

namespace App\Models;

use App\Models\Institute\InstituteBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAdmin extends Model
{
    use HasFactory;

    protected $table = 'institute_branch_admin';
    public $timestamps = false;

    public function branch_details() {
        return $this->hasOne(InstituteBranch::class,'id','institue_branch_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

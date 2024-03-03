<?php

namespace App\Models\Institute;

use App\Models\Asset\BranchAsset;
use App\Models\BranchAdmin;
use App\Models\CRM\CrmSmsTemplate;
use App\Models\CRM\Customers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteBranch extends Model
{
    use HasFactory;
    
    public function assets()
    {
        return $this->hasMany(BranchAsset::class);
    }

    public function institute_contact()
    {
        return $this->hasMany(InstituteContact::class);
    }

    public function institute_branch_contact()
    {
        return $this->hasMany(InstituteBranchContacts::class, 'intstitue_branch_id', 'id');
    }

    public function student()
    {
        return $this->belongsToMany(InstituteStudent::class);
    }

    public function teacher()
    {
        return $this->belongsToMany(InstituteTeacher::class);
    }

    public function classes()
    {
        return $this->hasMany(InstituteClass::class);
    }

    // public function branch_admin() {
    //     return $this->hasMany(BranchAdmin::class, 'institue_branch_id');
    // }

    public function branch_user()
    {
        return $this->belongsToMany(User::class);
    }

    public function branch_admin()
    {
        return $this->hasMany(BranchAdmin::class, 'institue_branch_id');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(UserRole::class, 'user_user_role', 'user_id', 'user_role_id', 'id', 'role_serial');
    // }

    public function branch_teacher()
    {
        return $this->belongsToMany(InstituteTeacher::class);
    }

    public function customers()
    {
        return $this->hasMany(Customers::class);
    }

    public function sms_templates()
    {
        return $this->hasMany(CrmSmsTemplate::class);
    }
}

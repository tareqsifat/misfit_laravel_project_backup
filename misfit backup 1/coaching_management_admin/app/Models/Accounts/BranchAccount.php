<?php

namespace App\Models\Accounts;

use App\Models\Institute\InstituteBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAccount extends Model
{
    use HasFactory;

    public function institute_branch()
    {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }

    public function category()
    {
        return $this->hasOne(AccountCategory::class, 'account_category_id', 'id');
    }

    public function income_log()
    {
        return $this->hasMany(BranchAccountLog::class, 'account_id', 'id');
    }

    public function expense_log()
    {
        return $this->hasMany(BranchAccountLog::class, 'account_id', 'id');
    }

    public function account_details()
    {
        return $this->hasOne(AccountDetails::class, 'account_id', 'id');
    }

}

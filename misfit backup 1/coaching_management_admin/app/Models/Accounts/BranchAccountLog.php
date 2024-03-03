<?php

namespace App\Models\Accounts;

use App\Models\Institute\InstituteBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAccountLog extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(AccountCategory::class, 'id', 'account_category_id');
    }
    
    public function account()
    {
        return $this->hasOne(BranchAccount::class, 'id', 'account_id');
    }

    public function branch()
    {
        return $this->hasOne(InstituteBranch::class,'id', 'branch_id');
    }
}

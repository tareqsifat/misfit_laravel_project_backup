<?php

namespace App\Models\CRM;

use App\Models\Institute\InstituteBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    public function call_history()
    {
        return $this->hasMany(CrmCallHistory::class);
    }

    public function branch() {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }

    public function sms_history()
    {
        return $this->hasMany(CrmSmsHistory::class);
    }
}

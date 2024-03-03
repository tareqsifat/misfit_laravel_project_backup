<?php

namespace App\Models;

use App\Models\Institute\InstituteClass;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;

    public function batch()
    {
        return $this->hasOne(InstituteClassBatch::class, 'id', 'batch_id');
    }

    public function class()
    {
        return $this->hasOne(InstituteClass::class, 'id', 'class_id');
    }

    public function subject()
    {
        return $this->hasOne(InstituteClassSubject::class, 'id', 'subject_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'table_id', 'id');
    }
}

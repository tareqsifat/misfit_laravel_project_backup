<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'doctor_id',
        'title',
        'description'
    ];



    public function doctor_info()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
    public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id', 'id');
    }
}

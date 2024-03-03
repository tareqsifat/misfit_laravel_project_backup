<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'name',
    'email',
    'phone',
    'user_id',
    'image',
    'blood_group',
    'birthday',
    'height',
    'weight',
    'gender',
    'address'
    ];
}

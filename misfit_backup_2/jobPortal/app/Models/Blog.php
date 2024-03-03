<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'images'
    ];
    use HasFactory;
    use SoftDeletes;
}

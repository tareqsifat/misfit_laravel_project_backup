<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];

    public function category_info()
    {
        return $this->belongsTo('App\models\Category', 'category_id', 'id');
    }
}

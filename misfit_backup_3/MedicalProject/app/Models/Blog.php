<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Blog extends Model
{
    use HasFactory;protected $fillable = [
        'image',
        'title',
    ];
    // public function Category()
    // {
    //     return $this->hasMany(Category::class);
    // }
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('approved',1);
    }
    public function reply()
    {
        return $this->hasManyThrough(Reply::class, Comment::class)->where('comments.approved',1)->where('replies.approved',1);
    }
    // public function subcategoris()
    // {
    //     return $this->hasOne(SubCategory::class);
    // }


    public function User_info()
    {
        return $this->belongsTo('App\Models\User', 'creator', 'id');
    }
    public function category_info()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function subcategory_info()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id', 'id');
    }
}

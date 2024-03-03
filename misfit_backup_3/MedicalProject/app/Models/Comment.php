<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'body'
    ];


    public function reply()
    {
        return $this->hasMany(Reply::class)->where('approved',1);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    // public function user_info()
    // {
    //     return $this->belongsTo('App\Models\User', 'creator', 'id');
    // }
    // public function blog_info()
    // {
    //     return $this->belongsTo('App\Models\Blog', 'blog_id', 'id');
    // }
}

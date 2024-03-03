<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    use HasFactory;


    protected $fillable = [
        'chat_id',
        'content',
        'sent_user_id',
        'get_user_id'
    ];
}

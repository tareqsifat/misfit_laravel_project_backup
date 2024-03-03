<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;


    protected $fillable = [
        'chat_id',
        'sent_user_id',
        'get_user_id',
    ];
    public function messages(){

        return $this->hasMany(Message::class,'chat_id','id');

    }

    public function user()
    {
        return $this->belongsTo(User::class,'sent_user_id','id');
    }



}

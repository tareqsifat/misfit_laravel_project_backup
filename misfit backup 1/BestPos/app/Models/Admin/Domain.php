<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'sub-domain',
        'user_id',
        'creator',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

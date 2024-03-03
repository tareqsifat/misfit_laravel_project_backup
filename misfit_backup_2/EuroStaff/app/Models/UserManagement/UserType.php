<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    public function userAccount(){
        return $this->hasMany(UserAccount::class, 'user_type_id', 'id');
    }
}

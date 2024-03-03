<?php

namespace App\Models\UserManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function notification_user()
    {
        return $this->hasMany(NotificationUser::class);
    }
}

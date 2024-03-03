<?php

namespace App\Models\SeekerProfile;

use App\Models\UserManagement\UserAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillSet extends Model
{
    use HasFactory;
    protected $user_id;
    protected $skill_set_name;
    protected $proficiency;

    protected $fillable = [
        'user_id',
        'skill_set_name',
        'proficiency'
    ];

    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }
}

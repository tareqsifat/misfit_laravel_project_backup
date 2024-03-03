<?php

namespace App\Models\CompanyProfile;

use App\Models\Job\JobPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    #make a scope named active for this model
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    #make a scope named inactive for this model
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function job_post()
    {
        return $this->hasMany(JobPost::class);
    }

    public function employer()
    {
        return $this->hasOne(Company::class);
    }
}

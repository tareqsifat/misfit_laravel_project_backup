<?php

namespace App\Models\Job;

use App\Models\CompanyProfile\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    public function setActiveAttribute($value): void
    {
        // Map string values to corresponding integers
        $statusMap = [
            'Inactive' => 0,
            'Active' => 1
        ];

        // Set the attribute with the mapped value
        $this->attributes['is_active'] = $statusMap[$value] ?? $value;
    }

    public function getActiveAttribute($value): string
    {

        // Map integer values to corresponding strings
        $statusMap = [
            0 => 'Inactive',
            1 => 'Active'
        ];
//dd($statusMap[$value] ?? $value);
        // Get the string representation from the map or use the original value
        return $statusMap[$value] ?? $value;
    }

    #make a one to one relation with company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    #make a one to one relation with job_type
    public function job_type()
    {
        return $this->belongsTo(JobType::class);
    }

    #make a active scope
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}

<?php

namespace App\Models\SeekerProfile;

use App\Models\CompanyProfile\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_current_job',
        'start_date',
        'end_date',
        'job_title',
        'company_name',
        'job_location_city',
        'job_location_state',
        'job_location_country',
        'description',
    ];

    public function getCityName()
    {
        if(isset($this->city_id))
            return DB::table('cities')->find($this->city_id)->name;
    }

    // Callback method to get state name
    public function getStateName()
    {
        if(isset($this->job_location_state))
            return DB::table('states')->find($this->job_location_state)->name;
    }

    // Callback method to get country name
    public function getCountryName()
    {
        if(isset($this->job_location_country))
        return DB::table('countries')->find($this->job_location_country)->name;
    }

    /**
     * Get the user that owns the experience.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}

<?php

namespace App\Models\SeekerProfile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_line',
        'place_mark',
        'user_account_id',
        'city_id',
        'state_id',
        'country_id',
    ];

    // Callback method to get city name
    public function getCityName()
    {
        return DB::table('cities')->find($this->city_id)->name;
    }

    // Callback method to get state name
    public function getStateName()
    {
        return DB::table('states')->find($this->state_id)->name;
    }

    // Callback method to get country name
    public function getCountryName()
    {
        return DB::table('countries')->find($this->country_id)->name;
    }
}

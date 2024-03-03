<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $table = 'availabilities';

    protected $fillable = ['location', 'time', 'status','date'];
    public function getlocation()
    {
        return $this->belongsTo(Location::class, 'location');
    }
    // Your additional model logic and relationships can be defined here
}

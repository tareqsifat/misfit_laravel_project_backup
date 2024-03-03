<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'status'];
    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'location');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
protected $fillable = ['user_id','timetable','location','appointment_id','status','problem'];
public function location()
{
    return $this->belongsTo(Location::class);
}
public function prescription()
{
    return $this->hasOne(Prescription::class,'appointment_id', 'appointment_id');
}

    public function timetable()
{
    return $this->hasOne(Availability::class,'location','location');
}
    public function user()
{
    return $this->belongsTo(User::class);
}

}

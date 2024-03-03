<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'monthly_charge',
        'yearly_charge',
        'half_yearly_charge',
        'flat_charge',
        'flat_time',
        'creator',
        'slug',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function planFeatures()
    {
        return $this->belongsToMany(PlanFeature::class);
    }
}

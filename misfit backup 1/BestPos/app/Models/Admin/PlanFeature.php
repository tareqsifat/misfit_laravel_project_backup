<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'key', 'creator', 'slug', 'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function pricingPlans()
    {
        return $this->belongsToMany(PricingPlan::class);
    }
}

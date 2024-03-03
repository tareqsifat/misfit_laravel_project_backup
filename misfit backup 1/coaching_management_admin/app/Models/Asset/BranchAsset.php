<?php

namespace App\Models\Asset;

use App\Models\Institute\InstituteBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAsset extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(AssetCategory::class, 'id', 'branch_id');
    }

    public function branch()
    {
        return $this->hasOne(InstituteBranch::class, 'id', 'branch_id');
    }
    public function shops()
    {
        return $this->belongsToMany(AssetShop::class);
    }
}

<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetShop extends Model
{
    use HasFactory;

    public function assets()
    {
        return $this->belongsToMany(BranchAsset::class);
    }

}

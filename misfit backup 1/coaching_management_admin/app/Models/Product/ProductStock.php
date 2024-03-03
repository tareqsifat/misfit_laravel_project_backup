<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function supplier()
    {
        return $this->hasOne(ProductSupplier::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}

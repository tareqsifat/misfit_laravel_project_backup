<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrderDetail extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

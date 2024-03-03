<?php

namespace App\Models\Product;

use App\Models\ProductDiscount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function stock_log()
    {
        return $this->hasMany(Product::class);
    }

    public function initial_stock()
    {
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }

    public function purchase_stock()
    {
        return $this->hasMany(ProductStockLog::class, 'product_id', 'id');
    }

    public function sell_stock()
    {
        return $this->hasMany(ProductStockLog::class, 'product_id', 'id');
    }

    public function discount()
    {
        return $this->hasOne(ProductDiscount::class, 'product_id', 'id');
    }
}

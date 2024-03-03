<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'category_id'           => 'json',
        'shipping_charge_id'    => 'json',
        'occasion_id'           => 'json',
        'recipient_id'          => 'json',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function addon_products() {
        return $this->hasMany(Addon_product::class,'addon_products','id');
    }
    public function product_categories(){
        return $this->hasMany(ProductCategory::class);
    }

    public function product_images(){
        return $this->hasMany(ProductImages::class);
    }

    public function product_attributes(){
        return $this->hasMany(ProductAttribute::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function product_variations() {
        return $this->hasMany(ProductVariation::class);
    }

    public function product_occasions() {
        return $this->hasMany(ProductOccasion::class);
    }

    public function product_recipients() {
        return $this->hasMany(ProductRecipient::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class)->with('user');
    }

    public function stock_ledger() {
        return $this->hasMany(StockLedger::class, 'product_id');
    }

    public function purchase_stock()
    {
        return $this->hasMany(ProductStock::class, 'product_id');
    }

    public function sell_stock()
    {
        return $this->hasMany(ProductStock::class, 'product_id');
    }

    public function scopeProductId($query)
    {
        return $query::where('status', 1)->select('id')->get();
    }

}

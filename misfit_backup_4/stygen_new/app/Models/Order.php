<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function order_attributes(){
        return $this->hasMany(OrderAttribute::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class);
    }

    public function shipping_status(){
        return $this->hasOne(ShippingStatus::class);
    }

    public function card(){
        return $this->belongsTo(Card::class);
    }

    public function packaging(){
        return $this->belongsTo(Packaging::class);
    }
}

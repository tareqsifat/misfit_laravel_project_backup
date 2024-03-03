<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Wallet extends Model
{
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }



    public function name(): Attribute
    {
        return new Attribute(
            get: fn () => @$this->currency->symbol . " Wallet",
        );
    }
    public function totalBalance(): Attribute
    {
        return new Attribute(
            get: fn () => @$this->on_order + $this->balance
        );
    }
}

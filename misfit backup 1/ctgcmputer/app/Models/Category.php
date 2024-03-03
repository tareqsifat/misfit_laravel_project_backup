<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('childrens');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        $data_query =  $this->belongsToMany(Product::class);
        // if (request()->has('varients')) {
        //     // dd(request()->varients);
        //     $data_query->whereExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('product_variant_value_products')
        //             ->where('product_variant_value_products.product_id', 'products.id')
        //             ->whereIn('product_variant_value_products.product_variant_value_id', request()->varients);
        //     });
        // }
        return $data_query;
    }

    public function products_custom()
    {
        return $this->belongsToMany(Product::class);
    }
}

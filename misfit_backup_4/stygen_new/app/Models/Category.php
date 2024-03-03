<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function product_categories(){
        return $this->hasMany(ProductCategory::class, 'category_id');
    }

    public function subcategory(){
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1)->with('subcategory');
    }
}

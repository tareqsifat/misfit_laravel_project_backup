<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Brand as ModelsBrand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Brand extends Component
{
    use WithPagination;
    public $brand;
    protected $paginationTheme = 'bootstrap';

    public function mount($slug)
    {
        $this->brand = ModelsBrand::where('brand_slug', $slug)->select('id')->first();
    }
    public function render()
    {
        
        if(isset($this->brand)){
            $products = Product::where('status', 1)->where('brand_id', $this->brand->id)->orderBy('id','desc')->with('brand','product_categories','product_images','product_variations');
        }
        
        return view('livewire.frontend.brand',[
            'products' => $products
            ->withSum(['purchase_stock' => function ($q) {
                $q->where('type', 'purchase');
            }], 'qty')
            ->withSum(['sell_stock' => function ($q) {
                $q->where('type', 'sell');
            }], 'qty')
            ->paginate(32),
        ])->extends('layouts.app', [
            'meta' => [
                
            ],
        ]);;
    }
}

<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Product;
use Livewire\Component;

class AllProductsOld extends Component
{
    
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $products = Product::orderBy('id','desc')->with(['brand']);
        // dd($this->products);

        return view('livewire.frontend.components.all-products',[
            'products' => $products->paginate(10),
        ]);
    }
}

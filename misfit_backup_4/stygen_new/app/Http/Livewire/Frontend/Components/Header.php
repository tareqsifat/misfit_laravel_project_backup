<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Http\Controllers\CartManagerController;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Header extends Component
{
    public $categories;
    public $cart_count=0;
    public $carts=null;

    public $searchQuery;
    public $search_products=[];

    public function search_product()
    {
        $query = Product::where('status', 1);
        $key = $this->searchQuery;
        if(strlen($key) > 0) {
            $query->where(function ($q) use ($key) {
                $q->Where('product_name', 'LIKE', '%' . $key . '%')
                ->orWhere('product_sku', 'LIKE', '%' . $key . '%');
            })->select('id', 'regular_price', 'pro_slug' ,'sales_price','product_name', 'featured_image');
            $this->search_products = $query->take(10)->get();
        }else {
            $this->search_products = null;
        }
    }

    public function updated($fields)
    {
        $this->search_product();

    }

    public function submitSearchPage()
    {
        return redirect()->route('search_product', $this->searchQuery);
    }


    public function render()
    {
        $cart_manager = new CartManagerController();
        $this->cart_count = $cart_manager->cart_count();
        $this->carts = $cart_manager->get();
        $this->categories = Category::where('status', 1)->where('parent_id', 0)->orderBy('id','asc')->with('subcategory')->get();

        // dd($this->categories->toArray());
        return view('livewire.frontend.components.header');
    }
}

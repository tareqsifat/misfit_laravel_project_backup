<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProduct extends Component
{
    use WithPagination;
    public $category;
    protected $paginationTheme = 'bootstrap';
    public $sort = "id-DESC";
    public function mount($slug)
    {
        $this->category = Category::where('cat_slug',$slug)->first();
        if(!$this->category) {
            abort(404, "No product found with this category");
        }
    }

    public function render()
    {
        $sortParts = explode('-', $this->sort);

        $column_name = $sortParts[0];
        $column_direction = $sortParts[1];

        $productIds = ProductCategory::where('category_id', $this->category->id)->get()->pluck('product_id');
        $meta_image = $this->category->category_image != null ? asset('assets/uploads/category') . '/' . $this->category->category_image : null;

        $meta_title = "Buy " . $this->category->category_name . " products in BD | Home delivery";
        if($this->category->meta_title != null && $this->category->meta_title !== "null") {
            $meta_title = $this->category->meta_title;
        }

        $meta_description = "Buy " . $this->category->category_name . " products in BD | Home delivery";
        if($this->category->meta_description != null && $this->category->meta_description != "null") {
            $meta_description = $this->category->meta_description;
        }

        return view('livewire.frontend.category-product', [
            'products' => Product::where('status', 1)->whereIn('id', $productIds)->orderBy($column_name, $column_direction)->with('brand','product_categories','product_images','product_variations')
            ->withSum(['purchase_stock' => function ($q) {
                $q->where('type', 'purchase');
            }], 'qty')
            ->withSum(['sell_stock' => function ($q) {
                $q->where('type', 'sell');
            }], 'qty')
            ->paginate(32),
            "meta_title" =>  $meta_title,
            "meta_description" => $meta_description,
            "meta_image" => $meta_image,
        ])->extends('layouts.app', [
            'meta' => [
                "title" =>  $meta_title,
                "description" => $meta_description,
                "image" => $meta_image,
                "og_image" => "",
                "twitter_image" => "",
                "price" => "" ,
                "keywords" => ""
            ],
        ]);
    }

    public function applySort()
    {
        // Force Livewire to re-render the component
        
        $this->render();
    }
}

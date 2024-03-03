<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AllProduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sort = "id-DESC";
    public function render()
    {

        $sortParts = explode('-', $this->sort);

        $column_name = $sortParts[0];
        $column_direction = $sortParts[1];
        return view('livewire.frontend.all-product', [
            'products' => Product::orderBy($column_name, $column_direction)->with(['brand'])
            ->withSum(['purchase_stock' => function ($q) {
                $q->where('type', 'purchase');
            }], 'qty')
            ->withSum(['sell_stock' => function ($q) {
                $q->where('type', 'sell');
            }], 'qty')
            ->paginate(32),
        ])->extends('layouts.app', [
            'meta' => [
                "title" =>  "Best online Gift Shop in Bangladesh | Stygen",
                "description" => "Order and send gifts online to your friends & family for any occasion. Gifts delivery in Bangladesh. Flower, cake, perfume, chocolate, books home delivery.",
                "image" => "{{ asset('assets/frontend/img/logo/stygen_image.jpg') }}",
                "og_image" => "asset('assets/frontend/img/logo/stygen_image.jpg')",
                "twitter_image" => "asset('assets/frontend/img/logo/stygen_image.jpg')",
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

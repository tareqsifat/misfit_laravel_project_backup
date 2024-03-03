<?php

namespace App\Http\Livewire\Frontend;

use App\Models\ProductOccasion;
use App\Models\Product;
use App\Models\Occasion;
use Livewire\Component;
use Livewire\WithPagination;

class OcassionProduct extends Component
{
    use WithPagination;
    public $occasion;
    protected $paginationTheme = 'bootstrap';
    public $sort = "id-DESC";

    public function mount($slug)
    {
        $this->occasion = Occasion::where('occasion_slug',$slug)->first();
    }

    public function render()
    {

        $sortParts = explode('-', $this->sort);

        $column_name = $sortParts[0];
        $column_direction = $sortParts[1];

        $productIds = ProductOccasion::where('occasion_id', $this->occasion->id)->get()->pluck('product_id');
        $meta_image = $this->occasion->occasion_image != null ? asset('assets/uploads/occasion') . '/' . $this->occasion->occasion_image : null;

        $meta_title = "Buy Best " . $this->occasion->occasion_name . " gift products in BD | Home delivery";
        if($this->occasion->meta_title != null && $this->occasion->meta_title !== "null") {
            $meta_title = $this->occasion->meta_title;
        }

        $meta_description = "Buy Best " . $this->occasion->occasion_name . " gift products in BD | Home delivery";
        if($this->occasion->meta_description != null && $this->occasion->meta_description != "null") {
            $meta_description = $this->occasion->meta_description;
        }

        return view('livewire.frontend.ocassion-product', [
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
            "meta_image" => $meta_image
            
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
        $this->render();
    }
}

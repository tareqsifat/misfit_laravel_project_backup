<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\View;
class Home extends Component
{
    public $landing_categories;
    public function render()
    {

        $this->landing_categories = Category::where('status', 1)->where('parent_id', 0)->where('approve_category', 1)->take(8)->get();
        View::share('landing_categories', $this->landing_categories);
        return view('livewire.frontend.home')
        ->extends('layouts.app', [
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
}

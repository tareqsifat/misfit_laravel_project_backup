<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Category;
use Livewire\Component;

class LandingCategories extends Component
{
    public $landing_categories;
    public function render()
    {

        return view('livewire.frontend.components.landing-categories');
    }
}

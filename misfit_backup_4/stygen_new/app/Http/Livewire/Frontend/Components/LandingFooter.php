<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Category;
use Livewire\Component;

class LandingFooter extends Component
{
    public $landing_categories;
    public function render()
    {
        $this->landing_categories = Category::where('status', 1)->where('parent_id', 0)->where('approve_category', 1)->take(8)->get();
        return view('livewire.frontend.components.landing-footer');
    }
}

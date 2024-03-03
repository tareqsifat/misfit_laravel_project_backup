<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Slider as ModelsSlider;
use Livewire\Component;

class Slider extends Component
{
    public $sliders;
    public function render()
    {
        $this->sliders = ModelsSlider::where('show_home_page', 1)->where('status', 1)->orderBy('id','asc')->with('occasion')->get();
        return view('livewire.frontend.components.slider');
    }
}

<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Occasion;
use Livewire\Component;

class LandingOccassion extends Component
{
    public $occasions;
    public function render()
    {
        $this->occasions = Occasion::where('showing_landing', 1)->where('status', 1)->take(12)->get();
        return view('livewire.frontend.components.landing-occassion');
    }
}

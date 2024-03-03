<?php

namespace App\Http\Livewire\Components;

use App\Models\Institute\InstituteBranch;
use Livewire\Component;

class Branch extends Component
{
    // public $branches;
    public function render()
    {
        // $this->branches=InstituteBranch::where('status', 1)->get();
        return view('livewire.components.branch');
    }
}

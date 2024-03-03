<?php

namespace App\Http\Livewire\Components;

use App\Models\Setting;
use Livewire\Component;

class Header extends Component
{
    public $mobile_number;
    public $site_email;
    public $logo;
    public function render()
    {
        $this->mobile_number = Setting::where('title', 'site_mobile_number')->first();
        $this->site_email = Setting::where('title', 'site_email')->first();
        $this->logo = Setting::where('title', 'site_logo')->first();
        return view('livewire.components.header');
    }
}

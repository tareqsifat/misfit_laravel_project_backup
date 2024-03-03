<?php

namespace App\Http\Livewire\Frontend;

use App\Models\CompanyInfo;
use Livewire\Component;

class BecomeSeller extends Component
{
    public $become_seller;
    public function render()
    {
        $this->become_seller = CompanyInfo::select('id','seller_page')->first();
        return view('livewire.frontend.become-seller')->extends('layouts.app', [
            'meta' => [
                "title" =>  "",
                "image" => "",
                "og_image" => "",
                "twitter_image" => "",
                "description" => "",
                "price" => "" ,
                "keywords" => ""
            ],
        ]);
    }
}

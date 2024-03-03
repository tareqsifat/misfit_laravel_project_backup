<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        return view('livewire.frontend.contact-us')->extends('layouts.app',[
            'meta' => [
                "title" =>  "Contact us - Stygen",
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

<?php

namespace App\Http\Livewire\Frontend;

use App\Models\CompanyInfo;
use Livewire\Component;

class AboutUs extends Component
{
    public $about_us;
    public function render()
    {
        $this->about_us = CompanyInfo::select('id','about')->first();
        return view('livewire.frontend.about-us')->extends('layouts.app', [
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

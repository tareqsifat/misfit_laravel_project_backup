<?php

namespace App\Http\Livewire\Frontend;

use App\Models\CompanyInfo;
use Livewire\Component;

class PrivacyPolicy extends Component
{
    public $privacy;
    public function render()
    {
        $this->privacy = CompanyInfo::select('id','privacy_policy')->first();
        return view('livewire.frontend.privacy-policy')->extends('layouts.app', [
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

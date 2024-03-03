<?php

namespace App\Http\Livewire\Frontend;

use App\Models\CompanyInfo;
use Livewire\Component;

class ReturnPolicy extends Component
{
    public $return_policy;
    public function render()
    {
        $this->return_policy = CompanyInfo::select('id','return_policy')->first();
        return view('livewire.frontend.return-policy')->extends('layouts.app', [
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

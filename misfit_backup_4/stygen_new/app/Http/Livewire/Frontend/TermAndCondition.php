<?php

namespace App\Http\Livewire\Frontend;

use App\Models\CompanyInfo;
use Livewire\Component;

class TermAndCondition extends Component
{
    public $terms;

    public function render()
    {
        $this->terms = CompanyInfo::select('id','terms_condition')->first();
        return view('livewire.frontend.term-and-condition')->extends('layouts.app', [
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

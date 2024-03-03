<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Blog as ModelsBlog;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $blogs = ModelsBlog::where('status', 1)->paginate(10)->onEachSide(3);
        return view('livewire.frontend.blog', ['blogs' => $blogs,])->extends('layouts.app',[
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

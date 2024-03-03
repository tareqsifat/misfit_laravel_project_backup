<?php

namespace App\Http\Livewire;

use App\Models\NewsEvent;
use Livewire\Component;

class NewsEventDetails extends Component
{
    public $news_event;
    public function mount($id)
    {
        $this->news_event = NewsEvent::where('id',$id)->first();
    }
    public function render()
    {
        return view('livewire.news-event-details')->extends('layouts.app');
    }
}

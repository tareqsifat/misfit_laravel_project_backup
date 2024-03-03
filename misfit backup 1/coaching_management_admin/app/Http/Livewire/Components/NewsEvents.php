<?php

namespace App\Http\Livewire\Components;

use App\Models\NewsEvent;
use App\Models\Notice;
use Livewire\Component;

class NewsEvents extends Component
{
    public $news, $notices;
    public function render()
    {
        $this->news = NewsEvent::latest()->take(8)->get();
        $this->notices = Notice::latest()->take(8)->get();
        return view('livewire.components.news-events');
    }
}

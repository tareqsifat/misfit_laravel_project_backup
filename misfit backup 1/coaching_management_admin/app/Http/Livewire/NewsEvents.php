<?php

namespace App\Http\Livewire;

use App\Models\NewsEvent;
use App\Models\Notice;
use Livewire\Component;
use Livewire\WithPagination;

class NewsEvents extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public function render()
    {
        
        $query = NewsEvent::query();

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }
    
        $news = $query->latest()->paginate(12);
    
        return view('livewire.news-events', [
            'news' => $news,
        ])->extends('layouts.app');
    }
}

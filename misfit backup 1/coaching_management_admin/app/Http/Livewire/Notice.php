<?php

namespace App\Http\Livewire;

use App\Models\Notice as ModelsNotice;
use Livewire\Component;
use Livewire\WithPagination;

class Notice extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $notices = null;
    public $search = '';
    public function render()
    {
        $query = ModelsNotice::query();
        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }
        $this->notices = $query->latest()->paginate(12);
        return view('livewire.notice', [
            'notices' => $this->notices
        ])->extends('layouts.app');
    }
}

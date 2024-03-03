<?php

namespace App\Http\Livewire;

use App\Models\Notice;
use Livewire\Component;

class NoticeDetails extends Component
{
    public $notice;
    public function mount($id)
    {
        $this->notice = Notice::where('id',$id)->first();
    }
    public function render()
    {
        return view('livewire.notice-details')->extends('layouts.app');
    }
}

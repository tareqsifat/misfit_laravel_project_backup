<?php

namespace App\Http\Livewire\Components;

use App\Models\Institute\InstituteTeacher;
use Livewire\Component;

class Lecturer extends Component
{
    public $teachers;
    public function render()
    {
        $this->teachers = InstituteTeacher::take(6)->with(['user'])->get();
        return view('livewire.components.lecturer');
    }
}

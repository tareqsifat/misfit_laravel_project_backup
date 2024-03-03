<?php

namespace App\Http\Livewire;

use App\Models\Institute\InstituteTeacher;
use Livewire\Component;
use Livewire\WithPagination;

class Teacher extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $teachers = InstituteTeacher::with(['user'])->paginate(7);
        return view('livewire.teacher', [
            'teachers' => $teachers
        ])->extends('layouts.app');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\BreakingNews;
use App\Models\Institute\InstituteBranch;
use App\Models\Institute\InstituteClass;
use App\Models\Institute\InstituteClassBatch;
use App\Models\Institute\InstituteClassBatchTimeSchedule;
use Livewire\Component;

class Home extends Component
{
    public $breaking_news;
    public $branches;
    public $tab_name;
    public $branch_id;

    
    public function render()
    {

        $this->breaking_news = BreakingNews::first();
        $this->branches=InstituteBranch::where('status', 1)->latest()->get();
        $this->branch_id = $this->branches[0]->id;
        return view('livewire.home')->extends('layouts.app');
    }

    

    
}

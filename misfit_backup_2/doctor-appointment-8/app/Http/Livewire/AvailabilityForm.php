<?php

namespace App\Http\Livewire;

use App\Models\Availability;
use App\Models\Location;
use Livewire\Component;

class AvailabilityForm extends Component
{
    public $selectedLocation;
    public $availableDates = [];

    public function render()
    {
        $locations = Location::all();
        return view('livewire.availability-form', [
            'locations' => $locations,
        ]);
    }

    public function updatedSelectedLocation($value)
    {
        $this->availableDates = Availability::where('location', $value)->get(['id', 'date'])->toArray();
    }
}

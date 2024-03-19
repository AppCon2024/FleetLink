<?php

namespace App\Livewire;

use App\Models\GeoLocation;
use App\Models\UserData;
use Livewire\Component;

class Tracking extends Component
{
    public function render()
    {
        $locations = UserData::all();
        return view('livewire.tracking',[
            'locations' => $locations
        ]);

    }
}

<?php

namespace App\Livewire;

use App\Models\Borrows;
use App\Models\GeoLocation;
use Livewire\Component;

class Tracking extends Component
{
    public function render()
    {
        $locations = GeoLocation::all();
        $user = Borrows::all();
        return view('livewire.tracking',[
            'locations' => $locations,
            'user' => $user
        ]);

    }
}

<?php

namespace App\Livewire;

use App\Models\GeoLocation;
use App\Models\Borrows;

use Livewire\Component;

class Tracking extends Component
{
    public function render()
    { $geoLocations = GeoLocation::all();
        $borrows = Borrows::all();

        return view('livewire.tracking', [
            'geoLocations' => $geoLocations,
            'borrows' => $borrows
        ]);
        
    }
}


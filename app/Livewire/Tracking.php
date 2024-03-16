<?php

namespace App\Livewire;

use App\Models\Borrows;
use App\Models\GeoLocation;
use Livewire\Component;

class Tracking extends Component
{
    public function render()
    {
        $locations = Borrows::where('time_out','- - -')->get();
        return view('livewire.tracking',[
            'locations' => $locations
        ]);
    }
}

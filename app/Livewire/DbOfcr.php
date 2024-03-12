<?php

namespace App\Livewire;

use App\Models\Vehicles;
use Livewire\Component;

class DbOfcr extends Component
{
    public function render()
    {
        $available = Vehicles::where('status', 1)->get();
        return view('livewire.db-ofcr',[
            'available' => $available,
        ]);
    }
}

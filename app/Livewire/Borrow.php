<?php

namespace App\Livewire;
use App\Models\Borrows;
use Livewire\Component;

class Borrow extends Component
{
    public function render()
    {
        $locations = Borrows::all();
        return view('livewire.tracking',[
            'locations' => $locations
        ]);
        
    }
}

<?php

namespace App\Livewire;

use App\Models\Vehicles;
use Livewire\Component;

class Qrcode extends Component
{

    public $vehicle;

    public function render()
    {
        $qrcode = Vehicles::all();
        return view('livewire.qrcode',
    ['qrcode' => $qrcode]);
    }
}

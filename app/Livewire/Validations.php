<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Validations extends Component
{
    #[Rule('required|min:2|max:50')]
    public $last_name;


    public function create(){
        $this->validate();
    }

    public function render()
    {
        return view('livewire.validations');
    }
}

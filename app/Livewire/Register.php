<?php

namespace App\Livewire;

use App\Models\Test;
use Livewire\Attributes\Rule;
use Livewire\Component;


class Register extends Component
{
    #[Rule('required|min:2|max:50')]
    public $name;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required|min:2')]
    public $password;

    public function create(){

        $validated = $this->validate();
        Test::create($validated);
        $this->reset('name','email','password');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $users = Test::all();
        return view('livewire.register',[
            'users' => $users,
        ]);
    }
}

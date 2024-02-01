<?php

namespace App\Livewire;

use App\Models\Test;
use Livewire\Attributes\Rule;
use Livewire\Component;
class Create extends Component
{
    #[Rule('required|min:2|max:50')]
    public $name;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required|min:2')]
    public $password;

    public function create(){

    }

    public function render()
    {
        $users = Test::all();
        return view('livewire.create',
        ['users' => $users,]);
    }
}

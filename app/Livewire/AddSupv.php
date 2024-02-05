<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AddSupv extends Component
{

    public $first_name, $last_name, $department, $position, $employee_id, $email;

    public function create(){
        $this->validate([
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'department' => 'required',
            'position' => 'required',
            'employee_id' => 'required|int|min:6',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'role' => 'supervisor',
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->first_name . ' ' . $this->last_name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'department' => $this->department,
            'position' => $this->position,
            'password' => '12345',
            'photo' => '',
            'last_seen' => null,
        ]);

        $this->reset('first_name','last_name','department','position','employee_id','email');
        $this->dispatch('close-modal');
        return redirect()->route('supervisors')->with('message', 'User was created successfully.');
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.add-supv',[
            'users' => $users
        ]);
    }
}

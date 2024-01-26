<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditSupv extends Component
{
    #[Rule('required|min:2|max:50')]
    public $first_name;

    public $editingSupvID;
    public $editingFirstName;


    public function edit($supvID){
        $this->editingSupvID = $supvID;
        $this->editingFirstName = User::find($supvID)->first_name;
    }

    public function render()
    {
        $data = User::where('role','supervisor');
        return view('livewire.edit-supv',
        ['data' => $data]);
    }
}

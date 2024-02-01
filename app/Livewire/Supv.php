<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Supv extends Component
{
    use WithPagination;


    #[Url(history:true)]
    public $search = '';

    #[Url()]
    public $perPage = 5;

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'ASC';



    public $role = "supervisor";


    #[Rule('required|min:2|max:50|string')]
    public $first_name;


    #[Rule('required|min:2|max:50|string')]
    public $last_name;

    #[Rule('required|min:6|max:6|int')]
    public $employee_id;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required')]
    public $department;

    #[Rule('required')]
    public $position;

    #[Rule('required')]
    public $photo;


    #[Rule('required|min:2')]
    public $password;

    public function updatedSearch(){
        $this->resetPage();
    }

    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function delete(User $user){
        $user->delete();
    }

    public function create(){

        $validated = $this->validate();
        User::create($validated);
        $this->reset('first_name','last_name','employee_id','email','department','position','password','photo');
        $this->dispatch('close-modal');
    }

    public $last_seen = '';
    public $online = '0';

    public function render()
    {
        $data = User::search($this->search)
        ->when($this->last_seen !== '',function($query){
            $query->where('last_seen',$this->online);
        })
        ->where('role', 'supervisor')
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);

        return view('livewire.tables.supv',
        ['data' => $data]);
    }
}

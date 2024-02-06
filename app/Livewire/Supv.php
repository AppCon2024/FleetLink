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

    public User $selectedUser;
    public $last_seen = '';
    public $online = '0';

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
        $this->selectedUser = $user;
        $this->dispatch('open-modal', name: 'delete');
    }
    public function delete_copy(User $user){
        $this->selectedUser = $user;

        $user->delete();

        return redirect()->route('supervisors')->with('message', 'User was deleted successfully.');
    }

    public function preview(User $user){
        $this->selectedUser = $user;
        $this->dispatch('open-modal', name: 'preview');
    }
    public $editing;
    public function edit(User $user){
        $this->selectedUser = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->dispatch('open-modal', name: 'edit');
    }



    public function edit_copy(User $user){
        $this->selectedUser = $user;

        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->first_name . ' ' . $this->last_name,
        ]);




        // $this->validate([
        //     'first_name' => 'required|min:2|max:50',
        //     'last_name' => 'required|min:2|max:50',
        //     'department' => 'required',
        //     'position' => 'required',
        //     'employee_id' => 'required|int|min:6',
        //     'email' => 'required|email|unique:users',
        // ]);

        // $this->update([
        //     'first_name' => $this->first_name,
        //     'last_name' => $this->last_name,
        //     'name' => $this->first_name . ' ' . $this->last_name,
        //     'employee_id' => $this->employee_id,
        //     'email' => $this->email,
        //     'department' => $this->department,
        //     'position' => $this->position,
        // ]);

        return redirect()->route('supervisors')->with('message', 'User was updated successfully');

    }




   public function resetInput(){
    $this->first_name = '';
    $this->last_name = '';
    $this->employee_id = '';
    $this->email = '';
    $this->department = '';
    $this->position = '';
   }

    public function create(){

        $validated = $this->validate();
        User::create($validated);
        $this->reset('first_name','last_name','employee_id','email','department','position','password','photo');
        $this->dispatch('close-modal');
    }



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

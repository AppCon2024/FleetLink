<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;


class Ofcr extends Component
{

    use WithPagination;
    use WithFileUploads;


    #[Url(history:true)]
    public $search = '';

    #[Url()]
    public $perPage = 5;

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'ASC';

    public $role = "police";
    public $first_name;
    public $last_name;
    public $employee_id;
    public $name;
    public $email;
    public $department;
    public $position;
    public $image;
    public $password = 12345;
    public $isOpen = 0;
    public $deleteOpen = 0;
    public $imageOpen = 0;
    public $postId;
    public $shift;



    public function create(){
        $this->reset('first_name','last_name','employee_id','email','department','position','postId','shift');
        $this->openModal();
    }

    public function store(){
        $this->validate([
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'department' => 'required',
            'position' => 'required',
            'employee_id' => 'required|int',
            'email' => 'required|email|unique:users',
            'shift' => 'required',
        ]);
        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->first_name . ' ' . $this->last_name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'department' => $this->department,
            'position' => $this->position,
            'shift' => $this->shift,
            'role' => $this->role,
            'image' => $this->image,
            'password' => $this->password,
            'last_seen' => null
        ]);
        session()->flash('message', 'Officer account created successfully.');
        $this->reset('first_name','last_name','employee_id','email','department','position');
        $this->closeModal();
    }

    public function delete($id){
        $post = User::find($id);
        $this->postId = $id;
        $this->name = $post->name;

        $this->deleteOpenModal();
    }

    public function remove(){
        if ($this->postId){
            $post = User::find($this->postId);
            $post->delete();

            session()->flash('message', 'Officer account deleted successfully.');
            $this->deleteCloseModal();
        }
    }
    public function view($id){
        $post = User::find($id);
        $this->postId = $id;
        $this->image = $post->image;
        $this->name = $post->name;

        $this->openImageModal();
    }

    public function edit($id)
    {
        $post = User::findOrFail($id);
        $this->postId = $id;
        $this->first_name = $post->first_name;
        $this->last_name = $post->last_name;
        $this->employee_id = $post->employee_id;
        $this->email = $post->email;
        $this->department = $post->department;
        $this->position = $post->position;
        $this->shift = $post->shift;

        $this->openModal();
    }
    public function update()
    {
        if ($this->postId) {
            $post = User::findOrFail($this->postId);
            $this->validate([
                'first_name' => 'required|min:2|max:50',
                'last_name' => 'required|min:2|max:50',
                'department' => 'required',
                'position' => 'required',
                'employee_id' => 'required|int',
                'shift' => 'required',
            ]);

            $post->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'name' => $this->first_name . ' ' . $this->last_name,
                'employee_id' =>$this->employee_id,
                'email' => $this->email,
                'department' => $this->department,
                'position' => $this->position,
                'shift' => $this->shift,
            ]);
            session()->flash('message', 'Officer account updated successfully.');
            $this->closeModal();
            $this->reset('first_name', 'last_name' ,'employee_id','email','department','position', 'postId');
        }
    }

    public function openModal(){
        $this->isOpen = true;
        $this->resetValidation();
    }

    public function closeModal(){
        $this->isOpen = false;
    }

    public function deleteOpenModal()
    {
        $this->deleteOpen = true;
    }

    public function deleteCloseModal()
    {
        $this->deleteOpen = false;
    }
    public function openImageModal()
    {
        $this->imageOpen = true;
    }
    public function closeImageModal()
    {
        $this->imageOpen = false;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $data = User::search($this->search)
        ->where('role', 'police')
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);
        return view('livewire.tables.ofcr',
        ['data' => $data]);
    }
    public function status($ofcrId)
    {
        $data = User::find($ofcrId);
        if($data){
            if($data->status){
                $data->status = 0;
            }
        else{
            $data->status = 1;
        }
        $data->save();
        }
        return back();
    }
}

<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Supv extends Component
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

    public $role = "supervisor";
    public $first_name;
    public $last_name;
    public $employee_id;
    public $name;
    public $email;
    public $department;
    public $position;
    public $password = 12345;

    public $isOpen = 0;
    public $deleteOpen = 0;
    public $imageOpen = 0;
    public $postId;

    public $image;
    public $newImage;
    public $station;
    public $shift;

    public $supvId;
    public $dropdownId = null;

    public function toggleDropdown($supvId)
    {
        if ($this->dropdownId === $supvId) {
            $this->dropdownId = null; // Close the dropdown
        } else {
            $this->dropdownId = $supvId; // Open the dropdown
        }
    }

    public function create()
    {
        $this->reset('first_name','last_name','employee_id','email','department','position','postId', 'image', 'newImage', 'shift','station');
        $this->openModal();
    }
    public function store()
    {
        $this->validate([
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'department' => 'required',
            'position' => 'required',
            'employee_id' => 'required|numeric|digits:6|unique:users',
            'email' => 'required|email|unique:users',
            'image' => 'required|image|max:1024',
            'station' => 'required',
            'shift' => 'required',
        ]);

        if($this->image){
            $fileName = 'fleetlink_' . $this->first_name .  $this->last_name .'.jpg';

            $this->image = $this->image->storeAs('images', $fileName, 'public');

            $this->image = 'storage/'.$this->image;
        }

        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->first_name . ' ' . $this->last_name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'department' => $this->department,
            'position' => $this->position,
            'station' => $this->station,
            'shift' => $this->shift,
            'role' => $this->role,
            'password' => $this->password,
            'last_seen' => null,
            'image' => $this->image,
        ]);

        session()->flash('message', 'Supervisor created successfully.');
        $this->reset('first_name','last_name','employee_id','email','department','position','image','shift','station');
        $this->closeModal();
    }
    public function delete($id)
    {
        $post = User::find($id);
        $this->postId = $id;
        $this->name = $post->name;
        $this->image = $post->image;

        $this->deleteOpenModal();
    }
    public function remove()
    {
        if ($this->postId){
            $post = User::find($this->postId);
            Storage::delete($post->image);
            $post->delete();

            session()->flash('message', 'Supervisor deleted successfully.');
            $this->deleteCloseModal();
        }
    }
    public function view($id)
    {
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
        $this->name = $post->name;
        $this->employee_id = $post->employee_id;
        $this->email = $post->email;
        $this->image = $post->image;
        $this->department = $post->department;
        $this->position = $post->position;
        $this->station = $post->station;
        $this->shift = $post->shift;

        $this->reset('newImage');
        $this->openModal();
    }
    public function update()
    {
        if ($this->postId) {
            $post = User::findOrFail($this->postId);
            $newImage = $post->image;
            if($this->newImage)
            {
                Storage::delete($post->image);
                $fileName = 'fleetlink_' . $this->first_name .  $this->last_name .'.jpg';
                $newImage = $this->newImage->storeAs('images', $fileName, 'public');
                $newImage = 'storage/'.$newImage;
            }
            $this->validate([
                'first_name' => 'required|min:2|max:50',
                'last_name' => 'required|min:2|max:50',
                'department' => 'required',
                'position' => 'required',
                'email' => 'required|email|unique:users,email,' .$post->id,
                'employee_id' => 'required|numeric|digits:6|unique:users,employee_id,'.$post->id,
                'station' => 'required',
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
                'image' => $newImage,
                'station' => $this->station,
                'shift' => $this->shift,
            ]);

            session()->flash('message', 'Supervisor updated successfully.');
            $this->closeModal();
            $this->reset('first_name', 'last_name' ,'employee_id','email','image','department','position', 'postId', 'shift','station');
            return redirect()->route('supervisors');
        }
    }
    public function openModal()
    {
        $this->isOpen = true;
        $this->resetValidation();
    }
    public function closeModal()
    {
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
    public $status = '';
    public function render()
    {
        $data = User::search($this->search)
        ->when($this->status !== '',function($query){
            $query->where('status', $this->status);
        })
        ->where('role', 'supervisor')
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);

        return view('livewire.tables.supv',
        ['data' => $data]);
    }

    public function status($supvId)
    {
        $data = User::find($supvId);
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

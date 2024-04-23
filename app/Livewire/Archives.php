<?php

namespace App\Livewire;

use App\Models\Archive;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Archives extends Component
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

    public $infoOpen = 0;
    public $region;
    public $province;
    public $city;
    public $barangay;
    public $street;
    public $zip;

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
        $this->dropdownId = null;
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

        Archive::create([
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
        $post = Archive::find($id);
        $this->postId = $id;
        $this->name = $post->name;
        $this->image = $post->image;

        $this->dropdownId = null;
        $this->deleteOpenModal();
    }
    public function remove()
    {
        if ($this->postId){
            $post = Archive::find($this->postId);

            Archive::create([
                'id' => $post->id,
                'status' => $post->status,
                'role' => $post->role,
                'first_name' => $post->first_name,
                'last_name' => $post->last_name,
                'name' => $post->name,
                'email' => $post->email,
                'employee_id' => $post->employee_id,
                'email_verified_at' => $post->email_verified_at,
                'department' => $post->department,
                'position' => $post->position,
                'station' => $post->station,
                'shift' => $post->shift,
                'password' => $post->password,
                'image' => $post->image,
                'last_seen' => $post->last_seen,
                'region_text' => $post->region_text,
                'province_text' => $post->province_text,
                'city_text' => $post->city_text,
                'barangay_text' => $post->barangay_text,
                'street' => $post->street,
                'zip_code' => $post->zip_code,
                'remember_token' => $post->remember_token,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
            ]);

            Storage::delete($post->image);
            $post->delete();

            session()->flash('message', 'Supervisor deleted successfully.');
            $this->deleteCloseModal();
        }
    }
    public function view($id)
    {
        $post = Archive::find($id);
        $this->postId = $id;
        $this->image = $post->image;
        $this->name = $post->name;

        $this->dropdownId = null;
        $this->openImageModal();
    }
    public function edit($id)
    {

        $post = Archive::findOrFail($id);
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

        $this->infoModalClose();
        $this->dropdownId = null;
        $this->reset('newImage');
        $this->openModal();
    }
    public function update()
    {
        if ($this->postId) {
            $post = Archive::findOrFail($this->postId);
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
    public function preview($id)
    {
        $post = Archive::find($id);
        $this->postId = $id;
        $this->image = $post->image;
        $this->name = $post->name;
        $this->department = $post->department;
        $this->position = $post->position;
        $this->employee_id = $post->employee_id;
        $this->email = $post->email;
        $this->shift = $post->shift;
        $this->region = $post->region_text;
        $this->province = $post->province_text;
        $this->city = $post->city_text;
        $this->barangay = $post->barangay_text;
        $this->street = $post->street;
        $this->zip = $post->zip_code;

        $this->dropdownId = null;
        $this->infoModal();
    }
    public function infoModal()
    {
        $this->infoOpen = true;
    }
    public function infoModalClose()
    {
        $this->infoOpen = false;
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
        $data = Archive::search($this->search)
        ->when($this->status !== '',function($query){
            $query->where('status', $this->status);
        })
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);

        $vhcl = Warehouse::all();

        return view('livewire.archives',[
            'data' => $data,
            'vhcl' => $vhcl,
        ]);
    }

    public function status($supvId)
    {
        $data = Archive::find($supvId);
        if($data){
            if($data->status){
                $data->status = 0;
            session()->flash('message', 'Officer account disabled successfully.');
            }
        else{
            $data->status = 1;
            session()->flash('message', 'Officer account enabled successfully.');
        }
        $data->save();
        }

        return back();
    }
}

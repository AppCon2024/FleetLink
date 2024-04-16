<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public $newImage;
    public $password = 12345;
    public $isOpen = 0;
    public $deleteOpen = 0;
    public $imageOpen = 0;
    public $infoOpen = 0;
    public $postId;
    public $station;
    public $shift;
    public $region;
    public $province;
    public $city;
    public $barangay;
    public $street;
    public $zip;

    public $dropdownId = null;

    public function toggleDropdown($ofcrId)
    {
        if ($this->dropdownId === $ofcrId) {
            $this->dropdownId = null; // Close the dropdown
        } else {
            $this->dropdownId = $ofcrId; // Open the dropdown
        }
    }



    public function create()
    {
        $this->reset('first_name','last_name','employee_id','email','department','position','postId','image', 'newImage','shift','station');
        $this->openModal();
        $this->dropdownId = null;
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
            'shift' => 'required',
            // 'station' => 'required',
        ]);

        if($this->image){
            $fileName = 'fleetlink_' . $this->first_name .  $this->last_name .'.jpg';

            $this->image = $this->image->storeAs('images', $fileName, 'public');

            $this->image = 'storage/'.$this->image;
        }

        if(Auth::user()->role == 'admin')
        {
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
                'image' => $this->image,
                'password' => $this->password,
                'last_seen' => null
            ]);
        }
        else{
            User::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'name' => $this->first_name . ' ' . $this->last_name,
                'employee_id' => $this->employee_id,
                'email' => $this->email,
                'department' => $this->department,
                'position' => $this->position,
                'station' => Auth::user()->station,
                'shift' => $this->shift,
                'role' => $this->role,
                'image' => $this->image,
                'password' => $this->password,
                'last_seen' => null
            ]);
        }
        session()->flash('message', 'Officer account created successfully.');
        $this->reset('first_name','last_name','employee_id','email','department','position','image','shift','station');
        $this->closeModal();
    }
    public function delete($id)
    {
        $post = User::find($id);
        $this->postId = $id;
        $this->name = $post->name;

        $this->dropdownId = null;
        $this->deleteOpenModal();
    }
    public function remove()
    {
        if ($this->postId){
            $post = User::find($this->postId);
            Storage::delete($post->image);
            $post->delete();

            session()->flash('message', 'Officer account deleted successfully.');
            $this->deleteCloseModal();
        }
    }
    public function view($id)
    {
        $post = User::find($id);
        $this->postId = $id;
        $this->image = $post->image;
        $this->name = $post->name;

        $this->dropdownId = null;
        $this->openImageModal();
    }

    public function preview($id)
    {
        $post = User::find($id);
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

    public function edit($id)
    {
        $this->infoModalClose();

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

        $this->dropdownId = null;
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
            session()->flash('message', 'Officer account updated successfully.');
            $this->closeModal();
            $this->reset('first_name', 'last_name' ,'employee_id','email','image','department','position', 'postId','shift','station');
            return redirect()->route('accounts');
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
        ->where('role', 'police')
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);


        $user = Auth::User()->station;
        $officer = User::search($this->search)
        ->when($this->status !== '',function($query){
            $query->where('status', $this->status);
        })
        ->where('role', 'police')
        ->where('station',$user)
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);

        $title = Auth::user()->station;

        return view('livewire.tables.ofcr',[
            'data' => $data,
            'officer' => $officer,
            'title' => $title,
        ]);
    }


    public function status($ofcrId)
    {
        $data = User::find($ofcrId);
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

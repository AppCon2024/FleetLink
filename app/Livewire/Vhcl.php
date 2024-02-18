<?php

namespace App\Livewire;

use App\Models\Vehicles;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Milon\Barcode\Facades\DNS1DFacade as DNS2D;



class Vhcl extends Component
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

    public $role = "vehicle";
    public $plate;
    public $brand;
    public $model;
    public $vin;
    public $user;
    public $unique_identifier;
    public $name = "Vehicle";
    public $status = 1;



    public $isOpen = 0;
    public $deleteOpen = 0;
    public $postId;



    public function create(){
        $this->reset('plate','brand','model','vin','postId');
        $this->openModal();
    }

    public function store(){
        $uniqueIdentifier = uniqid();

        $this->validate([
            'plate' => 'required|min:6|unique:vehicles',
            'brand' => 'required|min:2|max:50',
            'model' => 'required',
            'vin' => 'required|max:255|unique:vehicles',
        ]);
        Vehicles::create([
            'plate' => $this->plate,
            'brand' => $this->brand,
            'model' => $this->model,
            'vin' => $this->vin,
            'role' => $this->role,
            'name' => $this->name,
            'status' => $this->status,
            'unique_identifier' => $uniqueIdentifier,

        ]);
        session()->flash('message', 'Vehicle added successfully.');
        $this->reset('plate','brand','model','vin');
        $this->closeModal();
    }

    public function delete($id){
        $post = Vehicles::find($id);
        $this->postId = $id;
        $this->name = $post->name;

        $this->deleteOpenModal();
    }

    public function remove(){
        if ($this->postId){
            $post = Vehicles::find($this->postId);
            $post->delete();

            session()->flash('message', 'Supervisor deleted successfully.');
            $this->deleteCloseModal();
        }
    }

    public function edit($id)
    {
        $post = Vehicles::findOrFail($id);
        $this->postId = $id;
        $this->plate = $post->plate;
        $this->brand = $post->brand;
        $this->model = $post->model;
        $this->vin = $post->vin;
        $this->openModal();
    }
    public function update()
    {
        if ($this->postId) {
            $post = Vehicles::findOrFail($this->postId);
            $this->validate([
                'plate' => 'required|min:6|max:50',
                'brand' => 'required|min:2|max:50',
                'model' => 'required',
                'vin' => 'required',
            ]);

            $post->update([
                'plate' => $this->plate,
                'brand' => $this->brand,
                'model' => $this->model,
                'vin' => $this->vin,
            ]);
            session()->flash('message', 'Vehicle updated successfully.');
            $this->closeModal();
            $this->reset('plate', 'brand' ,'model','vin', 'postId');
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
        $data = Vehicles::search($this->search)
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);
        return view('livewire.tables.vhcl',
        ['data' => $data]);
    }
}

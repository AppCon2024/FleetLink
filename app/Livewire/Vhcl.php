<?php

namespace App\Livewire;

use App\Models\Vehicles;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;





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

    public $plate;
    public $brand;
    public $model;
    public $vin;
    public $station;
    public $type;
    public $user;
    public $qrcode;
    public $status = 1;

    public $isOpen = 0;
    public $deleteOpen = 0;
    public $qrOpen = 0;
    public $postId;

    public function generateQRCode()
    {
        $fileName = 'qrcode_' . $this->plate . '.svg';
        $filePath = public_path('qrcodes/' . $fileName); // Define the file path

        QrCode::size(200)->color(0, 0, 0)->generate($this->plate . ' ' . $this->model . ' ' . $this->brand . ' ' . $this->vin, $filePath);

        return '/qrcodes/' . $fileName; // Return the file path relative to the public directory
    }

    public function create()
    {
        $this->reset('plate','brand','model','vin','postId','station','type');
        $this->openModal();
    }

    public function store()
    {

        $this->validate([
            'plate' => 'required|min:6|unique:vehicles',
            'brand' => 'required|min:2|max:50',
            'model' => 'required',
            'vin' => 'required|max:255|unique:vehicles',
            'station' => 'required',
            'type' => 'required',

        ]);

        $qrcodeData = $this->generateQRCode();

        Vehicles::create([
            'plate' => $this->plate,
            'brand' => $this->brand,
            'model' => $this->model,
            'vin' => $this->vin,
            'station' => $this->station,
            'type' => $this->type,
            'status' => $this->status,
            'qrcode' => $qrcodeData,

        ]);
        session()->flash('message', 'Vehicle added successfully.');
        $this->reset('plate','brand','model','vin','station','type');
        $this->closeModal();
    }

    public function delete($id){
        $post = Vehicles::find($id);
        $this->postId = $id;


        $this->deleteOpenModal();
    }

    public function remove()
    {
        if ($this->postId){
            $post = Vehicles::find($this->postId);
            $post->delete();

            session()->flash('message', 'Vehicle deleted successfully.');
            $this->deleteCloseModal();
        }
    }
    public function view($id)
    {
        $post = Vehicles::find($id);
        $this->postId = $id;
        $this->plate = $post->plate;
        $this->qrcode = $post->qrcode;


        $this->openQrModal();
    }


    public function edit($id)
    {
        $post = Vehicles::findOrFail($id);
        $this->postId = $id;
        $this->plate = $post->plate;
        $this->brand = $post->brand;
        $this->model = $post->model;
        $this->vin = $post->vin;
        $this->station = $post->station;
        $this->type = $post->type;
        $this->openModal();
    }
    public function update()
    {
        if ($this->postId) {
            $post = Vehicles::findOrFail($this->postId);
            $this->validate([
                'plate' => 'required|min:6|max:50|unique:vehicles,plate,'.$post->id,
                'brand' => 'required|min:2|max:50',
                'model' => 'required',
                'vin' => 'required',
                'station' => 'required',
                'type' => 'required',
            ]);

            $qrcodeData = $this->generateQRCode();

            $post->update([
                'plate' => $this->plate,
                'brand' => $this->brand,
                'model' => $this->model,
                'vin' => $this->vin,
                'station' => $this->station,
                'type' => $this->type,
                'qrcode' => $qrcodeData,
            ]);
            session()->flash('message', 'Vehicle updated successfully.');
            $this->closeModal();
            $this->reset('plate', 'brand' ,'model','vin', 'postId','station','type');
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
    public function openQrModal()
    {
        $this->qrOpen = true;
    }
    public function closeQrModal()
    {
        $this->qrOpen = false;
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
        ['data' => $data,]);
    }
}

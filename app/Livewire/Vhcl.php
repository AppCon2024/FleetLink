<?php

namespace App\Livewire;

use App\Models\Vehicles;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
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
    public $dropdownId = null;
    public $isOpen = 0;
    public $deleteOpen = 0;
    public $qrOpen = 0;
    public $postId;

    public $mv, $cr, $eng, $cha;

    public function toggleDropdown($vhclId)
    {
        if ($this->dropdownId === $vhclId) {
            $this->dropdownId = null; // Close the dropdown
        } else {
            $this->dropdownId = $vhclId; // Open the dropdown
        }
    }

    public function generateQRCode()
{
    $fileName = $this->plate . '.svg';
    $filePath = storage_path('app/public/qrcodes/' . $fileName); // Define the file path

    $qrCodeContents = QrCode::size(200)->color(0, 0, 0)->generate($this->plate . ' ' . $this->model . ' ' . $this->brand . ' ' . $this->vin);

    \Illuminate\Support\Facades\Storage::disk('public')->put('qrcodes/' . $fileName, $qrCodeContents);

    return '/storage/qrcodes/' . $fileName; // Return the file path relative to the public directory
}

    public function create()
    {
        $this->reset('plate','brand','model','vin','postId','station','type', 'mv', 'cr', 'eng', 'cha');
        $this->dropdownId = null;
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'plate' => 'required|size:6|unique:vehicles|uppercase|regex:/^\S*$/',
            'mv' => 'required|size:17|unique:vehicles|uppercase|regex:/^\S*$/',
            'cr' => 'required|size:10|unique:vehicles|uppercase|regex:/^\S*$/',
            'eng' => 'required|size:13|unique:vehicles|uppercase|regex:/^\S*$/',
            'cha' => 'required|size:17|unique:vehicles|uppercase|regex:/^\S*$/',
            'brand' => 'required|min:2|max:50|uppercase|regex:/^\S*$/',
            'model' => 'required|min:2|max:50|uppercase|regex:/^\S*$/',
            'vin' => 'required|size:17|unique:vehicles|uppercase|regex:/^\S*$/',
            'station' => 'required',
            'type' => 'required',
        ],[
            'plate.regex' => 'The Plate number should not contain spaces.',
            'plate.required' => 'Plate number is required.',
            'plate.size' => 'Plate number should be 6 characters, it should not contain any space or dash.',
            'plate.uppercase' => 'Plate number should be capitalized',
            'plate.unique' => 'This Plate number is already available in the Database.',

            'mv.size' => 'The MV file number should be 17 characters.',
            'mv.required' => 'MV file number is required.',
            'mv.uppercase' => 'MV file number should be capitalized',
            'mv.unique' => 'This MV file number is already available in the Database.',
            'mv.regex' => 'MV file number should not contain spaces.',

            'cr.required' => 'CR number is required.',
            'cr.size' => 'The MV file number should be 10 characters including the dash.',
            'cr.unique' => 'This CR number is already available in the Database.',
            'cr.uppercase' => 'CR number should be capitalized',
            'cr.regex' => 'CR number should not contain spaces.',

            'eng.required' => 'Engine number is required.',
            'eng.size' => 'The Engine number should be 13 characters including the dash.',
            'eng.unique' => 'This Engine number is already available in the Database.',
            'eng.uppercase' => 'Engine number should be capitalized',
            'eng.regex' => 'Engine number should not contain spaces.',

            'cha.required' => 'Chassis number is required.',
            'cha.size' => 'The Chassis number should be 17 characters including the dash.',
            'cha.unique' => 'This Chassis number is already available in the Database.',
            'cha.uppercase' => 'Chassis number should be capitalized',
            'cha.regex' => 'Chassis number should not contain spaces.',

            'brand.required' => 'Vehicle make is required.',
            'brand.min' => 'Vehicle make should contain 2 letters above.',
            'brand.uppercase' => 'Vehicle make should be capitalized',
            'brand.regex' => 'Vehicle make should not contain spaces.',


            'model.required' => 'Vehicle series is required.',
            'model.min' => 'Vehicle series should contain 2 letters above.',
            'model.uppercase' => 'Vehicle series should be capitalized',
            'model.regex' => 'Vehicle series should not contain spaces.',


        ]);
        $qrcodeData = $this->generateQRCode();
        Vehicles::create([
            'plate' => $this->plate,
            'mv' => $this->mv,
            'cr' => $this->cr,
            'eng' => $this->eng,
            'cha' => $this->cha,
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

        $this->dropdownId = null;
        $this->deleteOpenModal();
    }

    public function remove()
    {
        if ($this->postId){
            $post = Vehicles::find($this->postId);
            Warehouse::create([
                'plate' => $post->plate,
                'mv' => $post->mv,
                'cr' => $post->cr,
                'eng' => $post->eng,
                'cha' => $post->cha,
                'brand' => $post->brand,
                'model' => $post->model,
                'vin' => $post->vin,
                'station' => $post->station,
                'type' => $post->type,
                'status' => $post->status,
                'qrcode' => $post->qrcode,
            ]);
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
        $this->station = $post->station;
        $this->brand = $post->brand;
        $this->model = $post->model;

        $this->qrcode = $post->qrcode;

        $this->dropdownId = null;
        $this->openQrModal();
    }


    public function edit($id)
    {
        $post = Vehicles::findOrFail($id);
        $this->postId = $id;
        $this->plate = $post->plate;
        $this->mv = $post->mv;
        $this->cr = $post->cr;
        $this->eng = $post->eng;
        $this->cha = $post->cha;
        $this->brand = $post->brand;
        $this->model = $post->model;
        $this->vin = $post->vin;
        $this->station = $post->station;
        $this->type = $post->type;
        $this->dropdownId = null;
        $this->openModal();
    }
    public function update()
    {
        if ($this->postId) {
            $post = Vehicles::findOrFail($this->postId);
            $this->validate([
                'plate' =>  'required|size:6|max:50|unique:vehicles,plate,'.$post->id,
                'mv' =>     'required|size:16|uppercase|unique:vehicles,mv,'.$post->id,
                'cr' =>     'required|size:10|uppercase|unique:vehicles,cr,'.$post->id,
                'eng' =>    'required|size:13|uppercase|unique:vehicles,eng,'.$post->id,
                'cha' =>    'required|size:17|uppercase|unique:vehicles,cha,'.$post->id,
                'brand' =>  'required|min:2|max:50|uppercase',
                'model' =>  'required|min:2|max:50|uppercase',
                'vin' =>    'required|size:17|uppercase|unique:vehicles,vin,'.$post->id,
                'station' =>'required',
                'type' =>   'required',
            ],[
                'plate.regex' => 'The Plate number should not contain spaces.',
                'plate.required' => 'Plate number is required.',
                'plate.size' => 'Plate number should be 6 characters, it should not contain any space or dash.',
                'plate.uppercase' => 'Plate number should be capitalized',
                'plate.unique' => 'This Plate number is already available in the Database.',

                'mv.size' => 'The MV file number should be 17 characters.',
                'mv.required' => 'MV file number is required.',
                'mv.uppercase' => 'MV file number should be capitalized',
                'mv.unique' => 'This MV file number is already available in the Database.',
                'mv.regex' => 'MV file number should not contain spaces.',

                'cr.required' => 'CR number is required.',
                'cr.size' => 'The MV file number should be 10 characters including the dash.',
                'cr.unique' => 'This CR number is already available in the Database.',
                'cr.uppercase' => 'CR number should be capitalized',
                'cr.regex' => 'CR number should not contain spaces.',

                'eng.required' => 'Engine number is required.',
                'eng.size' => 'The Engine number should be 13 characters including the dash.',
                'eng.unique' => 'This Engine number is already available in the Database.',
                'eng.uppercase' => 'Engine number should be capitalized',
                'eng.regex' => 'Engine number should not contain spaces.',

                'cha.required' => 'Chassis number is required.',
                'cha.size' => 'The Chassis number should be 17 characters including the dash.',
                'cha.unique' => 'This Chassis number is already available in the Database.',
                'cha.uppercase' => 'Chassis number should be capitalized',
                'cha.regex' => 'Chassis number should not contain spaces.',

                'brand.required' => 'Vehicle make is required.',
                'brand.min' => 'Vehicle make should contain 2 letters above.',
                'brand.uppercase' => 'Vehicle make should be capitalized',
                'brand.regex' => 'Vehicle make should not contain spaces.',


                'model.required' => 'Vehicle series is required.',
                'model.min' => 'Vehicle series should contain 2 letters above.',
                'model.uppercase' => 'Vehicle series should be capitalized',
                'model.regex' => 'Vehicle series should not contain spaces.',


            ]);

            $qrcodeData = $this->generateQRCode();

            $post->update([
                'plate' => $this->plate,
                'mv' => $this->mv,
                'cr' => $this->cr,
                'eng' => $this->eng,
                'cha' => $this->cha,
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

        $user = Auth::User()->station;
        $vehicle = Vehicles::search($this->search)
        ->where('station',$user)
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);

        return view('livewire.tables.vhcl',[
            'data' => $data,
            'vehicle' => $vehicle,
        ]);
    }
}

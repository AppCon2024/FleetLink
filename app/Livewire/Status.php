<?php

namespace App\Livewire;

use App\Models\Borrows;
use App\Models\Vehicles;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Status extends Component
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

    public function delete(Borrows $borrows){
        $borrows->delete();
    }

    public function render()
    {
        $data = Borrows::search($this->search)
        ->orderBy($this->sortBy,$this->sortDir)
        ->paginate($this->perPage);
        return view('livewire.tables.status',
        ['data' => $data]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
use Livewire\WithPagination;

class LivewireDatatables extends Component
{
  use WithPagination;
  public $sortBy='Code';
  public $sortDirection='asc';
  public $perpage=10;
  public $search='';
    public function render()
    {
      $courses=Course::query()
      ->search($this->search)
      ->orderBy($this->sortBy,$this->sortDirection)
      ->paginate($this->perpage);
        return view('livewire.livewire-datatables',['courses'=>$courses]);
    }
    public function sortBy($field){
        if($this->sortDirection=='asc'){
          $this->sortDirection='desc';
        }else{
          $this->sortDirection='asc';
        }
        return $this->sortBy=$field;
    }
    public function updatingSearch(){
      $this->resetPage();
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserDataTable extends Component
{
  use WithPagination;
  public $sortBy='id';
  public $sortDirection='asc';
  public $perpage=10;
  public $search='';
    public function render()
    {
      $users=User::query()
      ->search($this->search)
      ->orderBy($this->sortBy,$this->sortDirection)
      ->paginate($this->perpage);
        return view('livewire.user-data-table',['users'=>$users]);
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

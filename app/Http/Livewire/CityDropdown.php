<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CityList;
use App\Models\Search;
use Illuminate\Http\Request;

class CityDropdown extends Component
{
  use WithPagination;
  public $city;
  private$cities;
  public $selectedCity;

  // public

  public function mount()
  {
    $this->cities = CityList::all()
      ->sortBy('name');   
  }
  public function selectCity(Request $request)
  {
    //
  }
    public function render()
    {


        return view('livewire.city-dropdown', [
          'citynames' => $this->cities
        ]);
    }
}

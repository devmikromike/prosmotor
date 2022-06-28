<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CityList;

class City extends Component
{
   use WithPagination;
   public $city;
   // public $citynames = array();

    public function mount()
    {
        // $citynames = (new CityList())->loadCities();
    }
    public function cityDropdown()
    {

    }
    public function render()
    {
        return view('livewire.search.city', [
          'citynames' => CityList::paginate(10)
        ]);
    }
}

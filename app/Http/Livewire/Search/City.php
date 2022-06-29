<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CityList;

class City extends Component
{
   use WithPagination;
   public $city;
   private $citynames;

    public function mount()
    {
        // $citynames = (new CityList())->loadCities();
    }
    public function cityDropdown()
    {

    }
    public function render()
    {
        $cities = CityList::orderBy('name', 'asc');
        $citynames = $cities->paginate(10);
        //   $this->citynames = $citynames->toArray();
        $this->citynames = $citynames;


        return view('livewire.search.city', [
          'citynames' => $this->citynames
        ]);
    }
}

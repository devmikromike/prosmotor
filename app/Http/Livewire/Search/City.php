<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CityList;
use App\Models\PostCodeList;

class City extends Component
{
   use WithPagination;
   public $city;
   private$cities;
   private $citynames;
   public $postalCodes;
   public $code;
   public $selectedCity = NULL;

    public function mount()
    {
         $this->cities = CityList::orderBy('name', 'asc')->paginate(10);
         $this->postalCodes = collect();
    }
    public function updatedSelectedCity($city)
    {
        if (!is_null($city)) {
            $this->postalCodes = PostCodeList::where('city_lists_id', $city)
            ->orderBy('postalCode', 'asc')
            ->get();
        }
    }
    public function render()
    {
      return view('livewire.search.city', [
        'citynames' => $this->cities
      ]);
    }
}

<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CityList;
use App\Models\PostCodeList;
use App\Models\ProsBssLine;
use App\Models\Search;

class City extends Component
{
   use WithPagination;
   public $city;
   private$cities;
   public $postalCodes;
   public $postalCode;
   public $bssCodes;
   public $bssCode;
   public $code;
   public $selectedCity = NULL;
   public $SelectedPostalCode = NULL;
   public $SelectedBssCode = NULL;

    public function mount()
    {
         $this->cities = CityList::orderBy('name', 'asc')
         ->paginate(100);
          $this->bssCodes =  collect();
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
    public function updatedSelectedPostalCode($code)
    {
          $this->postalCode = $code;
            $this->bssCodes = ProsBssLine::orderBy('nameFI', 'asc')
            ->get();
    }
    public function updatedSelectedBssCode($bssCode)
    {
          $this->bssCode = $bssCode;
        // dd($this->postalCode, $this->bssCode );
        $response = (new Search())->perPostalCodeWithBssCode($this->postalCode, $this->bssCode);
    }
    public function render()
    {
      return view('livewire.search.city', [
        'citynames' => $this->cities
      ]);
    }
}

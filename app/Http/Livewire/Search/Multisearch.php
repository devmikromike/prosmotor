<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;

class Multisearch extends Component
{
    public $cityList;
    public $fieldCodeList;
    public $selectedCities;
    public $selectedFields;
    

    public function render()
    {
        return view('livewire.search.multisearch');
    }
}

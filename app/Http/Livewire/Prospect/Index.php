<?php

namespace App\Http\Livewire\Prospect;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Prospect;
use App\Models\CityList;
use App\Models\ProsBssLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Index extends Component
{
    public array $citynames = [];  // array in UI: index
    public array $codeIds = [];    // array in UI: index
    // public array $proslist = [];   // return from model ?!?
    public $message;              // success message to UI
    public $citylist;    // model
    public $codelist;  // model

    public function mount()
    {
      $this->citylist = new CityList();
      $this->prosBssLine = new ProsBssLine();

       //$this->$proslist =  $proslist;
    }
    public function booting()
    {
    //  $citylists = new CityList();
    //  $codelists = new ProsBssLine();
    }
     protected function rules()
     {
       $array = [
         'citynames' => ['required',Rule::in($this->citynames)],
      ];
      return $array;
     }
    public function submit()
    {
     session()->flash('message', 'haku on käynnistynyt! , olehan kärsivällinen ;-D ');
      $proslist =  (new CityList())->prosCityList($this->citynames);
    }
    public function render()
    {
      $citylists = CityList::CityAll()->toArray();
      $codelists = ProsBssLine::CodeAll()->toArray();
    //  dd($citylists);

      return view('livewire.prospect.index',
        ['citylists' => $citylists,
         'codelists' => $codelists
        // 'proslist' => $proslist
       ]);
    }
}

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
    public array $prosList = [];   // return from model ?!?
    public $message;              // success message to UI
    public $citylist;    // model
    public $prosBssLine;  // model

    public function mount()
    {
       $this->citylist = new CityList();
       $this->prosBssLine = new ProsBssLine();
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

    //  $this->validate();
    //  dump($this->citynames);
    //  dump('after validation');

     session()->flash('message', 'haku on käynnistynyt! , olehan kärsivällinen ;-D ');
      $prosList =  (new CityList())->prosCityList($this->citynames);

    //  dump($prosList);

   }

   // $cp = $prosCities['proslist'] ;

/*
    foreach ($cp as $p)
    /* $p  is collection
    *  $cp is multi collections
    */
  /*  {
      foreach ($p as $a)  // $a single prospect!.
      {
      //   dump ($a);
      //  dump( $a->id);
      $list[] = $a;
      }
    } */
    //  dump($list);

    public function boot()
    {
      // dump('booting .... ');
    }
    public function updatingSubmit()
    {
        dump('updating .... ');
    }
    public function updated()
    {
      // dump('updated .... ');
    }
    public function render()
    {
      $citylists = CityList::CityAll()->toArray();
      $codelists = ProsBssLine::CodeAll()->toArray();
      return view('livewire.prospect.index',
        ['citylists' => $citylists,
         'codelists' => $codelists
       ]);
    }
}

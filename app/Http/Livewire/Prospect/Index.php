<?php

namespace App\Http\Livewire\Prospect;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\Component;
use App\Models\Prospect;
use App\Models\CityList;
use App\Models\ProsBssLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Index extends Component
{

    public array $citynames = [];
    public array $codeIds = [];
    public array $prosCities = [];
    //public array $citiesforpros = [];
    public $citiesforpros;
    public array $cities = [];
    public $list = array();
    public $item;
    public $prospects;
    public $pros;

    protected $rules = [

    ];

    public function submit()
    {
      $cities = $this->citynames;
      $prosCities = CityList::cityList($cities);

// dump($prosCities['proslist'] );

   $cp = $prosCities['proslist'] ;
   

    foreach ($cp as $p)
    /* $p  is collection
    *  $cp is multi collections
    */
    {
      foreach ($p as $a)  // $a single prospect!.
      {
      //   dump ($a);
      //  dump( $a->id);
      $list[] = $a;
      }
    }
    //  dump($list);

//   return view('livewire.prospect.index');


        return view('livewire.prospect.index',
        ['list' => $prosCities['proslist']]);
    }

    public function render()
    {
      $citylist = CityList::CityAll()->toArray();
      $codelist = ProsBssLine::CodeAll()->toArray();
      return view('livewire.prospect.index',
        ['citylist' => $citylist,
         'codelist' => $codelist
       ]);
    }
}

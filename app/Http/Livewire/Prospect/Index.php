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

    public array $cityList = [];
    public array $citylist;
  //  public $idsList = array();
    public array $codeList = [];
    public array $codelist;

    protected $rules = [

    ];

    public function submit()
    {
      dd($cityList, $codeList);
    }

    public function mount()
    {
      $this->cityList = CityList::CityAll()->toArray();
      $this->codeList = ProsBssLine::CodeAll()->toArray();
    }

    public function render()
    {
    //  $cityList = CityList::CityAll()->toArray();
    //  $codeList = ProsBssLine::CodeAll()->toArray();

      // dd($cityList, $codeList);

        return view('livewire.prospect.index',
        ['citylist' => $this->cityList,
         'codelist' => $this->codeList
       ]);
        /*
        [ 'citylist' => CityList::CityAll(),
          'codelist' => ProsBssLine::CodeAll()
        ]);
        */
        /*
        ['cityList' => $cityList,
         'codeList' => $codeList
       ]); */

    }
}

<?php

namespace App\Http\Livewire\Prospect;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Http\Livewire\Prospect\Searchlist;
use App\Models\Prospect;
use App\Models\CityList;
use App\Models\ProsBssLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Index extends Component
{
    public array $citynames = [];  // array in UI: index
    public array $codeIds = [];    // array in UI: index
    public $proslist;   // return from model ?!?
    public $message;              // success message to UI
    public $citylist;    // model
    public $codelist;  // model
    public $sendproslist;
    public $codes;
    public $city;
    public $nameFI, $nameEN, $value;
    public $applocale;

    public function mount()
    {
        $this->citylist = new CityList();
        $this->prosBssLine = new ProsBssLine();
      //  $this->proslist = new Prospect(); // Not needed
        $value = session('applocale', 'en');
        $this->value = $value;
    }
     protected function rules()
     {
         $array = [
           'citynames' => ['required',Rule::in($this->citynames)],
        ];
        return $array;
     }
    public function updatingSubmit($sendproslist, $codes )
    {
      // data ok.
       $sendcodelist = $codes;
       $sendcitylist = $this->citynames;

       $this->emit('proslistCreated', $sendproslist);  // sent data to searchlist component
       $this->emit('codelistCreated', $sendcodelist);  // sent data to searchlist component
       $this->emit('citylistCreated', $sendcitylist);  // sent data to searchlist component
    }
    public function submit()
    {
       session()->flash('message', 'haku on käynnistynyt! , olehan kärsivällinen ;-D ');
        $sendproslist =  (new CityList())->prosCityList($this->citynames);
        $codes = (new ProsBssLine())->codeList($this->codeIds);

        $this->updatingSubmit($sendproslist, $codes);
        session()->flash('message', '');
    }
    public function render()
    {
      $citylists = CityList::CityAll()->toArray();
      $codelists = ProsBssLine::CodeAll()->toArray();
  //    $proslists = Prospect::with('locations')->ProsAll()->toArray();  // Not needed

      $this->citylists = $citylists;
      $this->codelists = $codelists;
  //    $this->proslists = $proslists;  // Not needed
      $value = $this->value;

      return view('livewire.prospect.index',
        ['citylists' => $citylists,
         'codelists' => $codelists,
    //     'proslists' => $proslists,  // Not needed
         'applocale' => $this->value
       ]);
    }
}

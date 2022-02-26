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
    public $name;

    public function mount()
    {
      $this->citylist = new CityList();
      $this->prosBssLine = new ProsBssLine();
      $this->proslist = new Prospect();
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

       $this->emit('proslistCreated', $sendproslist);  // data ok.
       $this->emit('codelistCreated', $sendcodelist);
       $this->emit('citylistCreated', $sendcitylist);
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
      $proslists = Prospect::with('locations')->ProsAll()->toArray();

      $this->citylists = $citylists;
      $this->codelists = $codelists;
      $this->proslists = $proslists;

      return view('livewire.prospect.index',
        ['citylists' => $citylists,
         'codelists' => $codelists,
         'proslists' => $proslists,
       ]);
    }
}

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
use App\Models\searchTemplate;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use File;

class Index extends Component
{
    public array $citynames = [];  // array in UI: index
    public array $codeIds = [];    // array in UI: index
    public $proslist;   // return from model ?!?
    public $message;              // success message to UI
    public $citylist;    // model
    public $codelist;  // model
    public $sendproslist;
    public $proslists;
    public $codes;
    public $city;
    public $nameFI, $nameEN, $value;
    public $applocale;
    public $fileName, $fileId;

    public function mount()
    {
        $this->citylist = new CityList();
        $this->prosBssLine = new ProsBssLine();

        $value = session('applocale', 'fi');
        $this->value = $value;
    }
     protected function rules()
     {
         $array = [
           'citynames' => ['required',Rule::in($this->citynames)],
        ];
        return $array;
     }
    public function newList($sendproslist, $codes )
    {

       $sendcodelist = $codes;

      // dd($sendproslist); // data ok.


       $this->emit('proslistCreated', $sendproslist);  // sent data to searchlist component
       $this->emit('codelistCreated', $sendcodelist);  // sent data to searchlist component
    //   $this->emit('citylistCreated', $sendcitylist);  // sent data to searchlist component
    }
    public function saveJsonData($sendproslist, $codes, $fileName = false)
    {

        if ($fileName)
        {
           $data['templateName'] = ($fileName);
           $fileName = $fileName. '_datafile.json';

        }else{
          $file['token'] = time();
          $fileName = $file['token']. '_datafile.json';
          $data['templateName'] = ('Default_'.$file['token']);
        }

        $file['token'] = time();
        $data['citylist'] = $sendproslist['citylist'];
        $data['codelist'] = $codes;
    //    $data['templateName'] = ('Default_'.$file['token']);
        $dataArray['data'] = json_encode($data);
    //    $fileName = $file['token']. '_datafile.json';
         File::put(public_path('/upload/'.$fileName),$dataArray);  // Check public folder, security!
       return $fileName;
    }

    public function saveTemplate( )
    {
      $modelSave = searchTemplate::updateOrCreate([
          'fileName' => $this->fileName
      ]);

      $this->fileId = $modelSave->id;
    }
    public function submit()
    {

    //  dd($this->citynames);

    //    session()->flash('message', 'haku on käynnistynyt! , olehan kärsivällinen ;-D ');
        $sendproslist =  (new CityList())->prosCityList($this->citynames);
        $this->proslists = $sendproslist;
      //  dd($sendproslist);

         $codes = (new ProsBssLine())->codeList($this->codeIds);
         $this->newList($sendproslist, $codes );
  //       session()->flash('message', 'haku on käynnistynyt! , olehan kärsivällinen ;-D ');
/*
        if ($this->fileName)
        {
           $this->saveJsonData($sendproslist, $codes, $this->fileName);
           $this->updatingSubmit($sendproslist, $codes);
          session()->flash('message', 'Search saved.');

        }else {
          $fileName = $this->saveJsonData($sendproslist, $codes);
          $this->updatingSubmit($sendproslist, $codes);
          session()->flash('message', 'Search saved by default template.');
        }     */

    }
    public function render()
    {
      $citylists = CityList::CityAll()->toArray();
      $codelists = ProsBssLine::CodeAll()->toArray();
  //    $proslists = Prospect::with('locations')->ProsAll()->toArray();  // Not needed

      $this->citylists = $citylists;
      $this->codelists = $codelists;
    //  $this->proslists = $proslists;  // Not needed
      $value = $this->value;

      return view('livewire.prospect.index',
        ['citylists' => $citylists,
         'codelists' => $codelists,
    //     'proslists' => $proslists,  // Not needed
         'applocale' => $this->value
       ]);
    }
}

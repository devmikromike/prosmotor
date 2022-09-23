<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use App\Http\Livewire\Prospect\Show;
//use App\Http\Livewire\Prospect\Table;
use App\Http\Livewire\Prospect\ShowPros;
use App\Models\Search;
use App\Models\ProsByVatId;
use App\Models\Prospect;
use App\Models\Contact;
use Illuminate\Support\Facades\Http;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SearchByVatid extends Component
{ // Search Form ///

    public Search $search;   // Search Model
    public $placeholder;
    protected $collection;
    public $vatId;
    public $vatID;
    public $SearchByVatId;
    public $response;
    public $data = array();
    public $results = array();
    public $statusMessage;
    public $nameLink;
    public $pros  = array();


    protected $rules = [
    'vatId' => 'required'
    ];

      public function submit( )
     {
        /* vat: 0858510-3   */
        //  dump($this->vatId);

      $this->validate();
        // (new Search())->perVatID($this->vatId);
           Log::info(' Send Vat id to Process! '.$this->vatId);
      $this->response = (new ProsByVatId())->search($this->vatId);   // new  process search
        Log::info(' Return response from Process! '.$this->vatId);
      $this->updatedSubmit();
      session()->flash('message', 'haku y-tunnuksella on käynnistynyt! , olehan kärsivällinen ;-D ');
    }
    public function updatedSubmit()
    {
          if(!empty($this->response))    // Model not empty!?
        {
           $httpRes = (new Search())->statusData($this->response);

              Log::info(' checking http status! '.$this->vatId);

           if($httpRes['Status']['status'] === 200)
           {
            Log::info('http status checked is 200 ');

             $this->data = $this->response;
             $this->response['Contacts'] = $this->data->contacts()->get();
             $this->response['Locations'] = $this->data->locations()->get();

               $this->emit('updatedData',[
                 'data' => $this->response
               ]);

             Log::info('emit trigged.... ');
              return view('livewire.search-by-vatid');
           }

          Log::info(' no http status! '.$httpRes['Status']['status']);
        }
    }

      public function render()
      {
          return view('livewire.search-by-vatid');
      //     ->extends('components.landingpage')
         // ->layout('landing');
          //  ->slot('home');
      }
}

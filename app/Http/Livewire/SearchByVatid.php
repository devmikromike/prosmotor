<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use App\Http\Livewire\Prospect\Show;
//use App\Http\Livewire\Prospect\Table;
use App\Http\Livewire\Prospect\ShowPros;
use App\Models\Search;
use App\Models\ProsByVatId;
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
    private $response;
    public $data = array();
    public $results = array();
    public $statusMessage;
    public $nameLink;
    public $pros  = array();


    protected $rules = [
    'vatId' => 'required'
    ];

    public function mount()
    {
      //  $this->search = new Search(); // Move to UP
    }

      public function submit( )
     {
        /* vat: 0858510-3   */
        //  dump($this->vatId);

      $this->validate();
        // (new Search())->perVatID($this->vatId);
           Log::info(' Send Vat id to Process! '.$this->vatId);
      $this->response = (new ProsByVatId())->search($this->vatId);   // new  process search
          Log::info(' Response from Process SearchByVatid-Component =  '.$this->response);

        if(!empty($this->response))    // Model not empty!?
      {
         $httpRes = (new Search())->statusData($this->response);

         if($httpRes['Status'] === 200)
         {
           $data = $this->response;

            if(!empty($data['Response']['results']))
            {

            $pros = $data['Response']['results'];
        //    dd($pros);

          //   return $pros = $data['Response']['results']->json();
          // $this->emit('byVatId', $this->vatId, $data);     // sent to show component
             return $pros;
            }


           // if(is_array($dataresult))
          //   if(is_array($data['results']))
            // {
            //   $resultsExist =  Arr::exists($data, 'results');

               return session()->flash('message', 'haku y-tunnuksella on käynnistynyt! , olehan kärsivällinen ;-D ');
          //   }


         }
      //     dd($httpRes['Status']);
           // dd($this->response['Response']['results']);

      }
      session()->flash('message', 'haku y-tunnuksella on käynnistynyt! , olehan kärsivällinen ;-D ');
    }
    /*
      public function render()
      {
          return view('livewire.search-by-vatid');
      } */
      public function render()
      {
          return view('livewire.search-by-vatid');
      //     ->extends('components.landingpage')
         // ->layout('landing');
          //  ->slot('home');
      }
}

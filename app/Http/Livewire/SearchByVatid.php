<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Prospect\Show;
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
    public $response;
    public $data = array();
    public $results = array();
    public $statusMessage;

    protected $rules = [
    'vatId' => 'required'
    ];
    public function emptyResponse()
    {
      if(!empty( $this->response['Response']))
      {
        return $statusMessage = '';
      }else {

         $statusMessage = $this->response['Status_message'];
      return  $statusMessage = $this->response['Status_message'];
      }
    }
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
        $response = (new ProsByVatId())->search($this->vatId);
          Log::info(' Response from Process! '.$response);

        if(!Empty($response))    // Model not empty!?
      {
          $this->emit('byVatId', $this->vatId);     // sent to show component
      }
     session()->flash('message', 'haku y-tunnuksella on käynnistynyt! , olehan kärsivällinen ;-D ');
    }
      public function render()
      {
          return view('livewire.search-by-vatid');
      }
}

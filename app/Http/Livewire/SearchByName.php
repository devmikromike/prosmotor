<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Search;
use App\Models\ProsByName;
use Illuminate\Support\Facades\Http;
use Session;
use Guzzle\Http\Exception\ClientErrorResponseException;

class SearchByName extends Component
{
  public $search;   // Search Model
  public $name;
  public $status;
  public $placeholder;
  public $results = [];
  public $response;
  public $res;
  public $statusMessage;
  public $message = 'uusi viesti!';

  protected $rules = [
  'name' => 'required'
  ];

  public function emptyResponse($response)
  {
    if(!empty( $this->response['Response']))
    {
      return $statusMessage = '';
    }else {
       $statusMessage = $this->response['Status_message'];
      return  $statusMessage = $this->response['Status_message'];
    }
  }

  public function updatedSubmit( )
 {
   $this->emit('notification', ['notimessage' => $message] );
 }

  public function submit( )
 {
    $this->validate();
    // $this->response  =  (new Search())->perName($this->name);
    $this->response  =  (new ProsByName())->search($this->name);

     
     // dd($this->response['sum']); // works!!!!

     if($this->response['sum'] > 1){

      $this->response['multi-mode'] =  $this->response;
      $this->emit('notification', ['prospect' => $this->response] );
        session()->put('message', 'Data received');

     }

    $this->emit('notification', ['prospect' => $this->response] );
    if(!empty ($this->response)){
        session()->put('message', 'Data received');
    }else{
      session()->put('message', 'Search in progress ');
    }
 }
  public function render()
  {
      return view('livewire.search-by-name');
  }
}

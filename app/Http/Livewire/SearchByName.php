<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Search;
use App\Models\ProsByName;
use Illuminate\Support\Facades\Http;
use Guzzle\Http\Exception\ClientErrorResponseException;

class SearchByName extends Component
{
  public $search;   // Search Model
  public $name;
  public $status;
  public $placeholder;
  public $results = '';
  public $response;
  public $res;
  public $statusMessage;

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
  public function submit( )
 {
    $this->validate();
    // $this->response  =  (new Search())->perName($this->name);
    $this->response  =  (new ProsByName())->search($this->name);
 }
  public function render()
  {
      return view('livewire.search-by-name');
  }
}

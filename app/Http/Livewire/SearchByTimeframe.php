<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Search;
use Illuminate\Support\Facades\Http;
use Guzzle\Http\Exception\ClientErrorResponseException;

class SearchByTimeframe extends Component
{
  public $search;   // Search Model
  public $name;
  public $status;
  public $placeholder;
  public $placeholder2;
  public $results = '';
  public $response;
  public $res;
  public $from;
  public $to;
  public $statusMessage;
  protected $rules = [
  'from' => 'required',
  'to'   => 'required'
  ];

  public function submit( )
  {
    $this->validate();
    //$this->response  =  (new Search())->perDates($this->from, $this->to);
    $this->response  =  (new Search())->createTimeFrameBatchJob($this->from, $this->to);
    $this->response = $this->response;
    if ($this->response)
    {
      $this->statusMessage = "Search is in Progress";
      return view('livewire.search-by-timeframe')->with('statusMessage', $this->statusMessage );
    }
    return view('livewire.search-by-timeframe');
  }
  public function render()
  {
      return view('livewire.search-by-timeframe');
  }
}

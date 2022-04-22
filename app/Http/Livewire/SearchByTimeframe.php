<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\BatchProcessing;
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
    $startTime = microtime(true);
    Log::info('Step 1 : Create TimeFrameBatchJob');
    //$this->response  =  (new Search())->perDates($this->from, $this->to);
    $this->response  =  (new BatchProcessing())->createTimeFrameBatchJob($this->from, $this->to);
    $this->response = $this->response;
    if ($this->response)
    {
      $seconds = number_format((microtime(true) - $startTime) * 1000, 2);  //WIP - check it! //
      Log::info('Final Response from Search-Model, Back to LIVEWIRE Component!:  ' .$seconds . ' millseconds');

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

<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ReadTimeFrameForApiJob;
use App\Models\TimeFrame;
use App\Models\Search;
use App\Listeners\TimeFrameBatch;

class ExtractTimeFrameEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $timeFrame;
    public $searchRowId;  //method!?!

    public function __construct(TimeFrame $timeFrame)
    {
      $this->timeFrame = $timeFrame;
      Log::notice('Step 16 :TimeFrame Event construct Done');
    }

    public function eventRowId($status)
    {
        Log::notice('Step 20:Event is sending status to TimeFrame-Model Scope');
        $model =  (new TimeFrame())->RowId($status);  //model::Scope
        Log::notice('Step 22: return TimeFrame-model from scope');       
        return $model;
        // dd($model['id']);
      //  (new SELF())->extractModelInfo($model);

    }
    /*
    public function extractModelInfo($model)
    {
      $rowIds=[];

      foreach ($model as $row)
      {
         $rowIds[] = $row->id;
         dump($rowIds);
      }
      return $rowIds;
    } */
}

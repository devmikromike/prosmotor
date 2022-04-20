<?php

namespace App\Listeners;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Events\ExtractTimeFrameEvent;
use App\Jobs\ReadTimeFrameForApiJob;
use App\Jobs\Step2Job;
use App\Models\Search;
use App\Models\TimeFrame;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class TimeFrameBatch
{
    public $event;
    public $batchId;
    public $startId, $lastId;
    public $rowIds = [];

    use Dispatchable, SerializesModels;

    public function handle(ExtractTimeFrameEvent $event)
    {
        Log::notice('step 17: Listeners triggered');
         $batch = Bus::batch([])
          ->name('GetTimeFrame')
        ->dispatch();
        $id = $batch->id;
        Log::notice('step 18: Second Batch created');
      $rowArray =  (new SELF())->search($batch, $event);
        return $batch;
    }
    public function search($batch, $event)
    {
        Log::notice('step 19: Listener is calling searchRowId with status:Start Setup ');

      if($rowData = $event->eventRowId('Start Setup'))
          {
            foreach ($rowData as $key => $row)
            {              
              Log::notice('step 19: inside foreach loop ');
              $rowId = $row->id;
              (new TimeFrame())->retRow($row->id);

          }
     }
     (new SELF())->searchSave($event);

      // $this->batchId = $batch->id;
    //  $job = $batch->add(new Step2Job($batchId));
        Log::notice('step 28: Listener is returning: rowData ');
      return $rowData;
    }

    public function searchSave($event)
    {
        Log::notice('step 26: Listener is returning: searchSave ');
      if($rowIdSave = $event->eventRowId('save end dates'))
          {
            foreach ($rowIdSave as $key => $row)
            {
                $rowId = $row->id;
                $this->rowIds[] = $rowId;
            }

          }
      (new SELF())->searchFinal($event);
      return $this->rowIds;
    }

    public function searchFinal($event)
    {
        Log::notice('step 27: Listener is returning: searchFinal ');
      if($rowFinal = $event->eventRowId('Final dates'))
          {
            foreach($rowFinal as $key => $row)
            {
              Log::notice('step 27: inside foreach loop ');
              $rowId = $row->id;
                (new TimeFrame())->retRow($row->id);
            }
       }
       return $this->rowIds;

  }
}

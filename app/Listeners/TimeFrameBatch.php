<?php

namespace App\Listeners;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Events\ExtractTimeFrameEvent;
use App\Jobs\ReadTimeFrameForApiJob;
use App\Jobs\Step2Job;
use App\Models\Search;
use App\Models\TimeFrame;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class TimeFrameBatch
{
    public $event;
    public $batch;
    public $batchId;
    public $startId, $lastId;
    public $rowIds = [];

    use Batchable, Dispatchable, SerializesModels;

    public function handle(ExtractTimeFrameEvent $event)
    {
        Log::notice('step 17: Listeners triggered');
      /*  $batch = Bus::batch([])
          ->name('GetTimeFrame')
        ->dispatch();
        $id = $batch->id;
        Log::notice('step 18: Second Batch created: '.$id);
      $rowArray =  (new SELF())->search($batch, $event);
        return $batch; */

       $batch =  (new SELF())->createBatch();
    //   $this->batchId = $bat->id;
   Log::notice('step 18: Second Batch created: '.$batch->id);

           (new SELF())->search($event, $batch);
    }
    public function createBatch()
    {
      $batch = Bus::batch([])
        ->name('GetTimeFrame')
        ->dispatch();
        $this->batch = $batch->id;

        return $batch;
    }
    public function search($event, $batch)
    {
      $rowData = $event->eventRowId('Start Setup');
      if($rowData)
          {
            Log::notice('step 19: Listener is calling searchRowId with status:Start Setup from Row: '.$rowData);

                (new TimeFrame())->retRow($rowData, $batch);

          Log::notice('step 28: Listener is returning: rowData ');
        return $rowData;
     }
      (new SELF())->searchSave($event, $batch);
    }

    public function searchSave($event, $batch)
    {
      $rowIdSave = $event->eventRowId('save end dates');
      if($rowIdSave)
          {
            Log::notice('step 26: Listener is returning: searchSave ');

                  (new TimeFrame())->retRow($rowIdSave,  $batch);

              return $this->rowIds;
          }
        (new SELF())->searchFinal($event, $batch);
    }

    public function searchFinal($event, $batch)
    {
      $rowFinal = $event->eventRowId('Final dates');
      if($rowFinal)
          {
              Log::notice('step 27: Listener is returning: searchFinal ');

                (new TimeFrame())->retRow($rowFinal, $batch);

           return $this->rowIds;
       }
  }
}

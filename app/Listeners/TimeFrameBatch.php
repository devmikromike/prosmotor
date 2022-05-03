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
        Log::notice('step 14: Listeners triggered');
       $batch =  (new SELF())->createBatch();
           (new SELF())->search($event, $batch);
        return;
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

      $rowData = $event->eventRowId('Start'); // return (Int) $rowData
        if($rowData)
            {
                      (new TimeFrame())->retRow($rowData, $batch);      
              return $rowData;
            }
          (new SELF())->searchSave($event, $batch);
       return;
    }

    public function searchSave($event, $batch)
    {
      $rowIdSave = $event->eventRowId('Save end dates'); // return Int (rowId)
      if($rowIdSave)
          {
          //  Log::notice('step 26: Listener is returning: searchSave ');

                  (new TimeFrame())->retRow($rowIdSave,  $batch);

              return $rowIdSave;
          }
        (new SELF())->searchFinal($event, $batch);
       return;
    }

    public function searchFinal($event, $batch)
    {
      $rowFinal = $event->eventRowId('Final');   // return Int (rowId)
      if($rowFinal)
          {
            //  Log::notice('step 27: Listener is returning: searchFinal ');

                (new TimeFrame())->retRow($rowFinal, $batch);

           return $rowFinal;
       }
     return;
  }
}

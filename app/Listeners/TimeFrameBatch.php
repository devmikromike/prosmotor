<?php

namespace App\Listeners;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Events\ExtractTimeFrameEvent;
use App\Jobs\ReadTimeFrameForApiJob;
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
        Log::notice('TimeFrameBatch Listeners triggered');
       $batch =  (new SELF())->createBatch();
           (new SELF())->search($event, $batch);
             Log::notice('TimeFrameBatch Listeners closed');
        return;
    }
    public function createBatch()
    {  /// GetTimeFrame is failing for timeout?
      $batch = Bus::batch([])
        ->name('GetTimeFrame')
        ->onQueue('timeFrame')
        ->dispatch();
        $this->batchId = $batch->id;
        Log::notice('TimeFrame Batch Created');
        return $batch;
    }
    public function search($event, $batch)
    {

      $rowData = $event->eventRowId('Start'); // return (Int) $rowData
        if($rowData)
            {   Log::notice('Start: in TimeFrameBatch Listener');
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
           Log::notice('Save end dates:  in TimeFrameBatch Listener');
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
             Log::notice('Final:  in TimeFrameBatch Listener');
                (new TimeFrame())->retRow($rowFinal, $batch);

           return $rowFinal;
       }
     return;
  }
}

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
        Log::notice('Listeners triggered');
         $batch = Bus::batch([])
          ->name('GetTimeFrame')
        ->dispatch();
        $id = $batch->id;
      $rowArray =  (new SELF())->search($batch, $event);
      dd($rowArray);
        return $batch;
    }
    public function search($batch, $event)
    {
      if($rowData = $event->searchRowId('Start Setup'))
          {
            foreach ($rowData as $key => $row)
            {
              $rowId = $row->id;
              $this->rowIds[] = $rowId;

          }
     }
     (new SELF())->searchSave($event);

      // $this->batchId = $batch->id;
    //  $job = $batch->add(new Step2Job($batchId));
    //  return $job;
    }

    public function searchSave($event)
    {
      if($rowIdSave = $event->searchRowId('save end dates'))
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
      if($rowFinal = $event->searchRowId('Final dates'))
          {
            foreach($rowFinal as $key => $row)
            {
              $rowId = $row->id;
              $this->rowIds[] = $rowId;
            }
       }
       return $this->rowIds;

  }
}

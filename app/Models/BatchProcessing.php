<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batchable;
use App\Jobs\TimeFrameJob;
use App\Jobs\ApiBridgeJob;
use App\Jobs\GetNewRowIdJob;
use App\Models\TimeFrame;
use App\Events\ExtractTimeFrameEvent;

class BatchProcessing extends Model
{
    use HasFactory, Batchable;

    public function createBatchJob($vatId)
    {
      $batch = Bus::batch([])
      ->name('ApiBridgeJob')
     ->dispatch();

      Log::notice('step 17: Created new Batch: '.$batch->name);
      Log::notice('step 17: Sending request for : '.$vatId);
       $batch->add(new ApiBridgeJob($vatId));

      return $batch;
      }
    /*  create batch and job   */
        public function createBatch($name)
        {
          $batch = Bus::batch([])
          ->name($name)
          ->dispatch();
           return $batch;
        }
        public function createBatchJobByVatID($vatId)
        {

        }
        public function createBatchJobBySearchList($name, $status)
        {
          $batch = (new SELF())->createBatch($name);
          $batch->add(new GetNewRowIdJob($status));
           return $batch;
        }
        public function createTimeFrameBatchJob($from, $to)
        { /* Receved call from Livewire component */
          Log::info('Step 2 : Create TimeFrameBatchJob from model-BatchProcessing');
        $batch  = (new SELF())->runBatchTimeFrame($from, $to );
        $name = $batch->name;
        Log::info('Step: 6 return TimeFrameBatchJob - main process Done');
        return ($name);
        }
        public function runBatchTimeFrame($from, $to)
        {
          Log::info('Step 3: Create Batch: ExtractTimeFrameJob');
          $batch = Bus::batch([])
            ->name('ExtractTimeFrameJob')
            ->then(function (Batch $batch) {
                (new SELF())->createTimeFrameEvent();
            })
            ->dispatch();
            Log::info('Step 4: Add Job to Batch');
          $batch->add(new TimeFrameJob($from, $to));

        /*    Log::info('Step: 5 call ExtractTimeFrameEvent');
          $timeFrame = new TimeFrame;
               event(new ExtractTimeFrameEvent($timeFrame));
                 Log::info('Step: 14 return batch info'); */
         Log::info('Step: 5 return batch info');
          return $batch;
        }
    /*  create batch and job   */
        public function createTimeFrameEvent()
        {
          Log::info('Step 15: call ExtractTimeFrameEvent');
          $timeFrame = new TimeFrame;
             event(new ExtractTimeFrameEvent($timeFrame));
           Log::info('Step: 14 return batch info');
        }

}
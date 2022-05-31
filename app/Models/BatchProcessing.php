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
use Carbon\Carbon;

class BatchProcessing extends Model
{
    use HasFactory, Batchable;

    public function createBatchJob($vatId)
    {
        $batch = Bus::batch([])
        ->name('ApiBridgeJob-'.$vatId)
       ->dispatch();

        //Log::info('step 17: Created new Batch: '.$batch->name);
        //Log::info('step 17: Sending request for : '.$vatId);
         $batch->add(new ApiBridgeJob($vatId));

        return $batch;
      }
    /*  create batch and job   */
        public function createBatch($name)
        {
            $batch = Bus::batch([])
            ->name($name)
            ->dispatch();
              //Log::info('Created new Batch: '.$batch->name);
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
              //Log::info('Step 2 : Create TimeFrameBatchJob from model-BatchProcessing');
            $batch  = (new SELF())->runBatchTimeFrame($from, $to );
            $name = $batch->name;
            //Log::info('Step: 6 return TimeFrameBatchJob - main process Done: '.$name);
            //Log::info('*****************************************************');
            return ($name);
        }
        public function runBatchTimeFrame($from, $to)
        {
            //Log::info('Step 3: Create Batch: ExtractTimeFrameJob');
            $batch = Bus::batch([])
              ->name('ExtractTimeFrameJob')
              ->then(function (Batch $batch) {
                    (new SELF())->createTimeFrameEvent();
              })
              ->dispatch();
              //Log::info('Step 4: Add Job to Batch');
            $batch->add(new TimeFrameJob($from, $to));

    //       Log::info('Step: 5 return batch info, First Batch Closed');
    //      Log::info('*****************************************************');
            return $batch;
        }
    /*  create batch and job   */
        public function createTimeFrameEvent()
        {
            //Log::info('Step 12: call ExtractTimeFrameEvent from BatchProcessing');
            $timeFrame = new TimeFrame;
               event(new ExtractTimeFrameEvent($timeFrame));
      //       Log::info('Step: 22 return Event and Closed.');
      //        Log::info('*****************************************************');
             return;
        }
}

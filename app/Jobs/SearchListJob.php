<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use App\Models\Search;

class SearchListJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     public $timeout = 300;
    public $startDate, $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function handle()
    {
      Log::info('JOB->  Pass start and end date data to API Bridge ');
        (new Search())->perDates($this->startDate, $this->endDate);  //API
/*
         Log::info('**************************');
        $lastRowId = (new LastRow())->GoNextRow();
           Log::info('Last row from TimeFrame:  '.$lastRowId);
        $batch = (new BatchProcessing())->createBatch('SearchList');
                  (new TimeFrame())->retRow($lastRowId, $batch);
       Log::info('**************************');   */
    }
}

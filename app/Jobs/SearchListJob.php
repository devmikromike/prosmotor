<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use App\Models\Search;

class SearchListJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

<<<<<<< HEAD
    public $timeout = 600;
=======
    public $timeout = 3600;
>>>>>>> 188708334a8f6f83c3cfbfa9e45f01de0746d3a4
    public $startDate, $endDate;
    public $rowId;
    public $uniqueFor = 3600;

    public function __construct($startDate, $endDate, $rowId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->rowId  = $rowId;
    }
    public function handle()
    {
      $startTime = microtime(true);
      $seconds = number_format((microtime(true) - $startTime) * 1000, 2);  //WIP - check it! //
      Log::info('SearchList JOB->  Pass start and end date data to API Bridge '.$this->startDate.' + '.$this->endDate);
        (new Search())->perDates($this->startDate, $this->endDate);  //API
        Log::info('SearchList JOB reply and closed! ');
        Log::info('ApiBridgeJob completed at:  ' .$seconds . '  millseconds');
      Log::info('**************************************************');
     return 1;
    }
    public function uniqueId()
    {
        return $this->rowId;        
    }
}

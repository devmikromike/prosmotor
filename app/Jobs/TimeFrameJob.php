<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Batchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use App\Models\Searchlist;
use App\Models\Search;
use App\Models\TimeFrame;
use App\Events\ExtractTimeFrameEvent;

class TimeFrameJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

    public $startRangeDate, $endRangeDate;
    public $timeout = 6000;

    public function __construct($from, $to)
    {
        $this->startRangeDate = $from;
        $this->endRangeDate = $to;
    }

    public function handle()
    {
        if ($this->batch()->cancelled()) {
            // Detected cancelled batch...
              Log::error('Job cancelled');
          return;
        }
        // Batched job executing... Extract TimeFrame to table.
          Log::info(' step 7:create date range and save it to timeframe table!');
           (new TimeFrame())->betweenDates($this->startRangeDate, $this->endRangeDate);
         Log::info('************ TimeFrame Job Completed *********** ');
      return;
    }
}

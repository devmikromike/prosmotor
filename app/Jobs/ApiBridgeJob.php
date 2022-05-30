<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Support\Facades\Log;
use App\Models\Search;

class ApiBridgeJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $vatId;
    public $timeout = 3600;

    public function __construct($vatId)
    {
      $this->vatId = $vatId;
    }

    public function handle()
    {
      $startTime = microtime(true);
        $seconds = number_format((microtime(true) - $startTime) * 1000, 2);  //WIP - check it! //
      Log::info(' Sending '.$this->vatId.' to API Bridge');
        sleep(20);
        (new Search())->perVatID($this->vatId);
          Log::info('ApiBridge JOB closed:!  '.$this->vatId.' in'.$seconds . ' millseconds');
      return;
    }
}

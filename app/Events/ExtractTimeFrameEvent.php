<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ReadTimeFrameForApiJob;
use App\Models\TimeFrame;
use App\Models\Search;
use App\Listeners\TimeFrameBatch;

class ExtractTimeFrameEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $timeFrame;
    public $searchRowId;  //method!?!

    public function __construct(TimeFrame $timeFrame)
    {

      $this->timeFrame = $timeFrame;
      Log::notice('TimeFrameJob Done');
    }

    public function searchRowId($status)
    {
      $model = (new TimeFrame())->RowId($status);     
      return $model;
    }
}

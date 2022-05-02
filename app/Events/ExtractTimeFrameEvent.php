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
    public $lastRowId;

    public function __construct(TimeFrame $timeFrame)
    {
        $this->timeFrame = $timeFrame;
      //  Log::notice('Step 13 :TimeFrame Event construct Done');
    }
    public function eventRowId($status)
    {
      //  Log::notice('Event is sending status to TimeFrame-Model: '.$status);
      //  Log::notice('****************************************************');
         $row = (new TimeFrame())->rowId($status);
      //    Log::notice('Step 21 return ExtractTimeFrameEvent Closed: '.$status);
      //      Log::notice('****************************************************');
        return $row;
    }
}

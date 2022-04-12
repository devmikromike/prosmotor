<?php

namespace App\Events;

use App\Listeners\TimeFrameBatch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\ReadTimeFrameForApiJob;
use App\Models\TimeFrame;
use App\Models\Search;

class ExtractTimeFrameEvent
{
    public $timeFrame;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct( )
    {
        //  $this->timeFrame = $timeFrame;

    }

    /**
     * Handle the event.
     *
     * @param  \App\Listeners\TimeFrameBatch  $event
     * @return void
     */
    public function handle(TimeFrameBatch  $event)
    {
      $batch = Bus::batch([])
      ->name('CallJob')
      ->dispatch();

    }
}

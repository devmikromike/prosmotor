<?php

namespace App\Listeners;

use App\Events\TimeFrameFinalEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\Search;

class TimeFrameListener
{

     public function __construct(Search $search)
     {
         $this->search = $search;
     }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TimeFrameFinalEvent  $event
     * @return void
     */
    public function handle(TimeFrameFinalEvent $event)
    {
        Log::info('Next Row!');
          (new Search())->nextRow();
        return 1;
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Batchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Searchlist;
use App\Models\Search;
use App\Models\TimeFrame;

class TimeFrameJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $startRangeDate, $endRangeDate;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($from, $to)
    {
        $this->startRangeDate = $from;
        $this->endRangeDate = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->batch()->cancelled()) {
            // Detected cancelled batch...
            return;
        }
        // Batched job executing... Extract TimeFrame to table.
          (new TimeFrame())->betweenDates($this->startRangeDate, $this->endRangeDate);
    }
}

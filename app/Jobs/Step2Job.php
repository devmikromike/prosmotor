<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Batch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\ExtractTimeFrameEvent;
use Illuminate\Support\Facades\Log;

class Step2Job implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $batchId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($batchId)
    {
      $this->id = $batchId;
          Log::notice('Step2Job triggered');
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
    public function batchComplete()
    {
       // do what you need here
        return;
    }
}

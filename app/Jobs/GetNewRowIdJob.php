<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;

class GetNewRowIdJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $status;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $status)
    {
      $this->status = $status;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      return 'Done';
    }
}

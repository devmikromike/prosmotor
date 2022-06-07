<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;
use App\Models\Search;

class ExtractJsonDataJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data = array();
    public $timeout = 3600;

    public function __construct($data)
    {

        $this->data = $data;
    }

    public function handle()
    {
          sleep(5);
        (new Search())->extractJson($this->data);
      return 1;
    }
}

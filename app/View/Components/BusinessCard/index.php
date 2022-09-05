<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
  public $data;
  public $prospect;
  
    public function __construct($data)
    {
        $this->data = $data;
      //  $this->logging();
    }

   public function logging()
   {
     Log::info('Index component logging ');

   }
    public function render()
    {
       Log::info('Index component logging ');
        return view('components.business-card.index');
    }
}

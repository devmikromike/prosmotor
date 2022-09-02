<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
  public $data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      Log::info('Index component render ');
      
        return view('components.business-card.index');
    }
}

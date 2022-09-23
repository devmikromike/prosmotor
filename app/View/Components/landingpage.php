<?php

namespace App\View\Components;

use Illuminate\View\Component;


class Landingpage extends Component
{
  //  public $cityList;
    public $nameLink = '';
    public $huhuu = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    // public function __construct( $cityList )
      public function __construct($huhuu = null )
    {
          $this->huhuu = $huhuu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
     
        return view('components.landingpage');
    }
}

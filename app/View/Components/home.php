<?php

namespace App\View\Components;

use Illuminate\View\Component;


class home extends Component
{
  //  public $cityList;
    public $nameLink = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    // public function __construct( $cityList )
      public function __construct( )
    {
    //     $this->cityList = $cityList;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.home');
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;


class landingpage extends Component
{
    public $cityList;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $cityList )
    {
         $this->cityList = $cityList;


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

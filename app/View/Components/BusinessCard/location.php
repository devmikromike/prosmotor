<?php

namespace App\View\Components\BusinessCard;

use Illuminate\View\Component;

class Location extends Component
{
    public $prospect;

    public function __construct($prospect=null)
    {
        $this->prospect = $prospect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.business-card.location');
    }
}

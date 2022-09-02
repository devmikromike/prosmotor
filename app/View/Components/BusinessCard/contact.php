<?php

namespace App\View\Components\BusinessCard;

use Illuminate\View\Component;
use App\Models\Prospect;
use App\Models\Contact as Contacts;

class contact extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
     public $prospect;
     public $contacts;

    public function __construct(Prospect $prospect, Contact $contacts  )
    {
       $this->prospect = $prospect;
       $this->contacts = $prospect->contacts()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      Log::info('Contact component render ');
        return view('components.business-card.contact');
    }
}

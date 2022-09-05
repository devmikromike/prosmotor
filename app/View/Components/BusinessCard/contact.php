<?php

namespace App\View\Components\BusinessCard;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

use App\Models\Contact as Contacts;

class contact extends Component
{
     public $prospect;
     public $contacts;
     public $contact;
     public $name;

    public function __construct()
    {
     // $this->prospect = $prospect;
      // $this->contacts = $prospect->contacts()->get();
    }

    public function render()
    {
  //    dump($prospect);
      Log::info('Contact component render ');
        return view('components.business-card.contact');
    }
}

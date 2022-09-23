<?php

namespace App\View\Components\BusinessCard;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;
use App\View\Components\Index;

use App\Models\Contact as Contacts;

class contact extends Component
{
     public $prospect;
     public $contacts;
     public $contact;
     public $name;
     public $data;
     public $index;

    public function __construct($prospect=null)
    {
        $this->prospect = $prospect;

      // $this->contacts = $prospect->contacts()->get();
    }

    public function render()
    {


    // dump($prospect);
      Log::info('Contact component render');
        return view('components.business-card.contact');
    }
}

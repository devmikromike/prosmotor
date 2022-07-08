<?php

namespace App\Http\Livewire\BusinessCard;

use Livewire\Component;

class Contact extends Component
{
    public $tab = 'contact';
    public function render()
    {
        return view('livewire.business-card.contact');
    }
}

<?php

namespace App\Http\Livewire\BusinessCard;

use Livewire\Component;

class Main extends Component
{
    public $tab = 'main';
    public function render()
    {
        return view('livewire.business-card.main');
    }
}

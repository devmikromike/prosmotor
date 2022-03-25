<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prospect;

class BusinessCard extends Component
{
    public Prospect $prosmodel;
    public $name;
    public $pros_id;

    public function mount($pros_id)
    {
        // $this->pros_id = $pros_id;
        $this->pros_id =  $pros_id;
    }

    public function render()
    {
        return view('livewire.business-card')
                 ->extends('layouts.app');
    }
}

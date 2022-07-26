<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $showVatid = false;
    public $showName= false;
    public $showTimeFrame= false;
    public $showCity= false;

    public function render()
    {
        return view('livewire.sidebar');
    }

    public function openByVatid()
    {
        $this->showVatid =! $this->showVatid;
    }
    public function openByName()
    {
        $this->showName =! $this->showName;
    }

    public function openByTimeFrame()
    {
        $this->showTimeFrame=! $this->showTimeFrame;
    }
    public function openByCity()
    {
        $this->showCity=! $this->showCity;
    }
}

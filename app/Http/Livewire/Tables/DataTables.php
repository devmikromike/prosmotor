<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Session;

class DataTables extends Component
{
    public $prospect;
    public $update;
    public $message;

    protected $listeners = [
      'notification'
    ];

    public function refresh() {
      $this->update = !$this->update;
    }

    public function notification($prospect)
    {
      $this->prospect = $prospect;

      dd($prospect);
      
      $this->refresh();

        session()->put('message', '');
    }

    public function render(): View
    {
        return view('livewire.tables.data-tables');
    }
}

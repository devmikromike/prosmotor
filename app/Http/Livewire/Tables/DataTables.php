<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Http\Livewire\SearchByVatid;
use Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DataTables extends Component
{
    public $prospect;
    public $update;
    public $message;
    public $data;

    protected $listeners = [
      'notification', 'updatedData'
    ];

    public function refresh() {
      $this->update = !$this->update;
    }
    public function updatedData($data)
    {
       //    $this->refresh();
    //   dd($data);
        $this->data = $data;
         Log::info('receiving data from emit....SearchByVatid! ');
          $this->refresh();
    return view('livewire.tables.data-tables');
        //     return view('livewire.tables.data-tables',['$data' => $data]);
    }

    public function notification($prospect)
    {
      $this->prospect = $prospect;



      $this->refresh();

        session()->put('message', '');
    }

    public function render(): View
    {
        return view('livewire.tables.data-tables');
    }
}

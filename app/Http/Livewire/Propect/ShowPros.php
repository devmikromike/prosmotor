<?php

namespace App\Http\Livewire\Propect;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Prospect;
use App\Models\ProsBssLine;
use App\Http\Livewire\SearchByVatid;

class ShowPros extends Component
{
  public $pros = array();
  protected $listeners = [
    'byVatId' ];

    public function  byVatId(Response $response, $pros)
    {
      // dd($pros);
    }
    public function render()
    {
        return view('livewire.propect.show-pros');
    }
}

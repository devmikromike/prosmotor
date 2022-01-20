<?php

namespace App\Http\Livewire\Prospect;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\Component;
use App\Models\Prospect;
use App\Models\CityList;
use App\Models\ProsBssLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Index extends Component
{  

    public function render()
    {
        return view('livewire.prospect.index');

    }
}

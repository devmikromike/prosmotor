<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputBoxForVat extends Component
{
    public $name ='';
    public $vatID ='';
    public $placeholder ='';

    public function mount($name, $placeholder)
   {
       $this->name = $name;
       $this->placeholder = $placeholder;
   }
    public function render()
    {
        return view('livewire.input-vatbox');
    }
}

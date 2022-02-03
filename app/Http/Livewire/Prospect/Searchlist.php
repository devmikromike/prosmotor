<?php

namespace App\Http\Livewire\Prospect;

use Livewire\Component;
use App\Http\Livewire\Prospect\Index;

class Searchlist extends Component
{
     public array $newproslist = [];
     public  array $proslists;
     private $myindex;
     public $sendproslist;
     protected $listeners = ['proslistCreated'];

    public function proslistCreated($sendproslist)
    {    // dump($proslist);  // data ok.
        $this->newproslist = $sendproslist;
    }
    public function mount(Index $index)
    {
      $this->myindex =  $index;
    }
    public function render( )
    {
     $newproslist = $this->newproslist;
      // dump($newproslist);  // data ok. // last place
      // no dato to UI (view).
        return view('livewire.prospect.searchlist',
          [
            'proslists' => $newproslist,
          ]);
    }
}

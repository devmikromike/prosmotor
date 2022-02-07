<?php

namespace App\Http\Livewire\Prospect;

use Livewire\Component;
use App\Http\Livewire\Prospect\Index;
use App\Models\Prospect;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Searchlist extends Component
{

     public array $newproslist = [];
     public array $newcodelist = [];
     public array $newcitylist = [];
     public array $citylists = [];
     public  array $proslists;
     public  array $proslist;
     private $myindex;
     public $sendproslist;
     public $sendcodelist;
     public $sendcitylist;

     protected $listeners = [
       'proslistCreated', 'codelistCreated','citylistCreated' ];

    public function proslistCreated($sendproslist)
    {
      $this->newproslist = $sendproslist;
    }
    public function codelistCreated($sendcodelist)
    {
      $this->newcodelist = $sendcodelist;
    }
    public function citylistCreated($sendcitylist)
    {
      $this->newcitylist = $sendcitylist;
    }
    public function mount(Index $index)
    {
      $this->myindex =  $index;
    }
    public function render( )
    {
       $newproslist = $this->newproslist;  // Total Prospects per city(is) and business field(s)
       $newcodelist = $this->newcodelist;
       $newcitylist = $this->newcitylist;
        return view('livewire.prospect.searchlist',
          [
            'proslists' => $newproslist,
            'newcodelist' => $newcodelist,
            'newcitylist'=> $newcitylist
          ]);
    }
}

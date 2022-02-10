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
     public array $proslists;
     public array $proslist;
     private $myindex;
     public $sendproslist;
     public $sendcodelist;
     public $sendcitylist;
     public $City;
     public $city;

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
    public function updatedCity($value)
    {
    //  dump($value);
      // if(trim($pros['city']) == trim($value))
      $city = str_replace(' ', '', $value);
      foreach ($this->newproslist as $proslist) {

          $step1 =  Arr::exists($this->newproslist, 'proslist');

          if($step1 === true)
         {
            if(!empty($proslist)){

               foreach($proslist as $prospect)
               {
                 if(!empty($prospect))
                     { session()->flash('message', 'Pieni hetki! ');
                       foreach ($prospect as $pros)
                       {
                         $step2 =  Arr::isNull($prospect);
                         dd($step2);

                       }
                      }else {
                              session()->flash('message', 'Haetussa kaupungissa ei ole vielä yhtään Prospektia! ');
                            }

               } // end of foreach
           }
         }
        }
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

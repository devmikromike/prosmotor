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
     public array $prospectlist = [];
     public array $newcodelist = [];
     public array $newcitylist = [];
     public array $citylists = [];
     public array $proslists;
     public array $proslist;
     public array $prospectarray = [];
     public array $pros = [];
     private $myindex;
     public $sendproslist;
     public $sendcodelist;
     public $sendcitylist;
     public $selectedCity;
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
    public function updatedSelectedCity($value)
    {
      // if(trim($pros['city']) == trim($value))
      $city = str_replace(' ', '', $value); // deleted extra space.
      $prospect = [];
      $pros = [];
      $prospectlist = [];
      foreach ($this->newproslist as $proslist) {
          $step1 =  Arr::exists($this->newproslist, 'proslist');

          if($step1 === true)
         {
            if(!empty($proslist)){

               foreach($proslist as $key => $prospectarray)
               {
                  
                 if(!empty($prospectarray))
                     {
                        dd($prospectarray);
                       session()->flash('message', 'Pieni hetki! ');
                       foreach ($prospectarray as  $pros) /// ?????
                       {    // " Invalid argument supplied for foreach() "

                         if($city === $pros['city'])
                         {
                           $prospectlist[] = $pros; // Works ! ;-D ;-D
                           dump($city, $pros['city'], $prospectlist);
                         } else {
                           continue;
                         }
                       }
                      }else {
                              session()->flash('message', 'Haetussa kaupungissa ei ole vielä yhtään Prospektia! ');
                    }
                  //   dd($prospectlist);
                 }
              }
            }
          //  $newproslist = $this->prospectlist;
            $newproslist['proslist'] = $prospectlist;
      //      dump($prospectlist);
    }
  //  $newproslist = $this->prospectlist;
  //  $newproslist['proslist'] = $prospectlist;
  //  dump($newproslist);
     session()->flash('message', 'Lista päivitetty!');

    return $newproslist;
  } // end of function
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

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
     public $update;

     protected $listeners = [
       'proslistCreated', 'codelistCreated','citylistCreated' ];
       // 'refreshSearchList' => $refresh

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

    public function refresh() {
      $this->update = !$this->update;
    }
    public function updatedSelectedCity($value)
    {
      // if(trim($pros['city']) == trim($value))
      $city = str_replace(' ', '', $value); // deleted extra space.
      $prospect = [];
      $pros = [];
      $prospectlist = [];
      foreach ($this->newproslist as $proslist) {
          $step1 =  Arr::exists($this->newproslist, 'proslist'); //<- input

          if($step1 === true)
         {
            if(!empty($proslist)){

               foreach($proslist as $key => $prospectarray)
                {
                //  dd(is_array($prospectarray));

                 if(is_array($prospectarray))
                  // if(!empty($prospectarray))   /// <- ???
                     {
                      //   dump($prospectarray );
                       session()->flash('message', 'Pieni hetki! ');
                       foreach ($prospectarray as $pros) /// <- ?????
                       {    // " Invalid argument supplied for foreach() "


                         if($city === $pros['city'])
                         {
                              // dump($pros );
                           $prospectlist[] = $pros; // Works ! -> output


                         } else { }
                       }
                      }else {
                          /*    $pros = 'Ei yritystietoja';
                              $prospectlist[] = $pros;
                              $newproslist['proslist'] = $prospectlist;  */
                        // dd($prospectlist);
                              session()->flash('message', 'Haetussa kaupungissa ei ole vielä yhtään Prospektia! ');
                    }
                 }  // end of foreach ($proslist as $key => $prospectarray)
              } // end of if(!empty($proslist)
            } // end of if($step1 === true)

            // $newproslist['proslist'] = $prospectlist;



    } // end of first foreach.
    //  dump($newproslist['proslist']);
     session()->flash('message', 'Lista päivitetty!');
       $newproslist['proslist'] = $prospectlist;
       $this->newproslist =  $newproslist;
  //       dd($newproslist);
       $this->refresh();
     // $this-> refreshComponent();

    //  $this->emit('refreshSearchList');

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

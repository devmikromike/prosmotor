<?php

namespace App\Http\Livewire\Tables;

use Livewire\Component;
use App\Http\Livewire\Prospect\Show;
use App\Models\Prospect;
use App\Http\Livewire\SearchByVatid;

class Table extends Component
{
    public $vatId;
    public $response;
    public $update;
    public $name;
    protected $listeners = [
    'byVatId' ];

    public function refresh() {
      $this->update = !$this->update;
    }

    public function  byVatId($id, $prosmodel = null )
    {

      dd($id);

       if(!empty($prosmodel)){
           $prosmodel['process_status'] = 'OK';
           $bssField = Prospect::find($id)->bssCodeField()->first();
           $prosmodel['nameFI'] = $bssField->nameFI;
           $prosmodel['bsscode'] = $bssField->code;
           $location = Prospect::find($id)
             ->locations()
             ->VisitAddress()
             ->EndDate()
             ->first();

           if (!empty($location['street'])){
             $prosmodel['street'] = $location->street;
             $prosmodel['postCode'] = $location->postCode;
             $prosmodel['city'] = $location->city;
           }

           $this->prosmodel =  $prosmodel;
           $this->refresh();

           return $prosmodel;
         }else {
           $this->vatId = $vatId;
           foreach ($response as $key => $value) {

            // $name  = $value['name'];
           }
             $this->refresh();
         }
      return view('livewire.tables.table',[
        'prosmodel' => $prosmodel]);
    }

    public function render()
    {
        return view('livewire.tables.table');
    }
}

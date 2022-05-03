<?php

namespace App\Http\Livewire\Prospect;

use Livewire\Component;
use App\Models\Prospect;
use App\Models\ProsBssLine;
use App\Http\Livewire\SearchByVatid;

class Show extends Component
{
  public $prospect = array();
  // private $myindex;

  public $businessId;
  public $prosmodel, $bssField, $myindex;
  public $message;
  public $searchById;
  public $update;
  public $vatId, $name, $www;

  protected $listeners = [
    'byVatId' ];

/*
    public function mount(
                    SearchByVatid $searchByVatId,
                    Prospect $prosmodel,
                    ProsBssLine $bssField)
    {
      $this->myindex =  $searchByVatId;
    } */


    public function refresh() {
      $this->update = !$this->update;
    }

    public function  byVatId($vatId)
    {
     $prosmodel = (new Prospect())->getId($vatId);
      if(!empty($prosmodel)){
          $id = $prosmodel->id;
          $bssField = Prospect::find($id)->bssCodeField()->first();
          $prosmodel['nameFI'] = $bssField->nameFI;
          $prosmodel['bsscode'] = $bssField->code;
          $location = Prospect::find($id)
            ->locations()
            ->VisitAddress()
            ->EndDate()
            ->first();
          if (!empty($prosmodel['street'])){
            $prosmodel['street'] = $location->street;
            $prosmodel['postCode'] = $location->postCode;
            $prosmodel['city'] = $location->city;

          }
          $this->prosmodel =  $prosmodel;
          $this->refresh();
          return $prosmodel;
        }else {
          $this->vatId = $vatId;
            $this->refresh();
        }
    }
    public function render()
    {
        $prosmodel = $this->prosmodel;
        return view('livewire.prospect.show',[
          'prosmodel' =>   $prosmodel,
        ]);
    }
}

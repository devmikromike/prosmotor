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

    public function byVatId($vatId)
    {
      $prosmodel = (new Prospect())->getId($vatId);
      $id = $prosmodel->id;
      $bssField = Prospect::find($id)->bssCodeField()->first();
      $prosmodel['nameFI'] = $bssField->nameFI;
      $prosmodel['bsscode'] = $bssField->code;
      $location = Prospect::find($id)
        ->locations()
        ->VisitAddress()
        ->EndDate()
        ->first();

      $prosmodel['street'] = $location->street;
      $prosmodel['postCode'] = $location->postCode;
      $prosmodel['city'] = $location->city;
      $this->prosmodel =  $prosmodel;
      $this->refresh();
      return $prosmodel;
    }

    public function render()
    {
        $prosmodel = $this->prosmodel;
  //       dd($prosmodel);
     /*   "id" => 2
    "name" => "Mafisa Oy"
    "vatId" => "0858510-3"
    "www" => "www.mafisa.fi"
    "registrationDate" => "1991-10-09"
    "created_at" => "2022-02-17 09:35:22"
    "updated_at" => "2022-02-17 09:35:22"
    "nameFI" => "Muu tekninen palvelu"
    "bsscode" => 71129
    "street" => "Ollilantie 14 C"
    "postCode" => "00780"
    "city" => "HELSINKI"
     */

        return view('livewire.prospect.show',[
          // 'prospect' => $prospect,
          'prosmodel' =>   $prosmodel,
        ]);
    }
}

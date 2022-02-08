<?php

namespace App\Http\Livewire\Prospect;

use Livewire\Component;
use App\Models\Prospect;
use App\Http\Livewire\SearchByVatid;

class Show extends Component
{
  public $prospect = array();
  private $myindex;
  public $data= array();
  public $businessId;
  public $prosmodel;


  protected $listeners = [
    'byVatId' ];

    public function mount(
                    SearchByVatid $searchByVatId,
                    Prospect $prosmodel)
    {
      $this->myindex =  $searchByVatId;
    }
    public function byVatId($data)
    {
      $this->data = $data;
      $prospect = $data['Response']['results'];
      $this->prospect = $prospect;

      $id = $prospect[0];
      $vatId = $id['businessId'];
      $pros = (new Prospect())->getId($vatId);
      $this->prosmodel = $pros;
    }

    public function render()
    {
        $prosmodel = $this->prosmodel;
        $prospect = $this->prospect;


        return view('livewire.prospect.show',[
          'prospect' => $prospect,
          'pros' =>   $prosmodel
        ]);
    }
}

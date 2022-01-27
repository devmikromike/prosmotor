<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Prospect;

class Proslist extends Model
{
    use HasFactory;

    public function proscities($prosCities)
    {
      $results = [];
      $pros = [];

      foreach ($prosCities['proslist'] as $prospects)
       { // for 'totalproslist'
         foreach ($prospects as $pros)
         {
           $vatId = $pros['vat_id'];
           $pros['name'] = Prospect::getName($vatId);
           $pros_model = Prospect::getId($vatId);
           $pros['pros_id'] = $pros_model->id;
           $pros['www'] = $pros_model->www;
           // return code and nameFI in Array!
          (int)$pros['bssCode'] = Prospect::getBssCode($vatId);
           $results[] = $pros;
         }
       }
       // total list of Prospect ; all cities and business linecodes.
         return $results;
    }
}

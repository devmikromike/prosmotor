<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proscounter extends Model
{
    use HasFactory;

    public function countProsPerCity($results)
    {// total count of selected cities times Bss
      $total = count($results);



      return $total;
    }
    public function countBssPerCity()
    {// total

    }
    public function PerCity()
    {// array

    }
    public function PerBssPerCity()
    {// array

    }
}

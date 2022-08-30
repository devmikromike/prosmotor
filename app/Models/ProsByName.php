<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ProsByName extends Model
{
    use HasFactory;

    public function search($name)
    {
      // Search from Prospects  table
      if($response = (new Prospect())->getName($name))
       {
          Log::info(' Prospect Process = true '.$name);
          return $response;
       }else
       {
         /* Search per Single name */
            Log::info(' Prospect Process = false '.$name);
           $response =  (new Search())->perName($name);
          return $response;
       }
    }
}

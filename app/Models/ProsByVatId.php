<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProsBlackListed;
use App\Models\Prospect;
use Illuminate\Support\Facades\Log;

class ProsByVatId extends Model
{
    use HasFactory;

    public function search($vatId)
    {
      // Search from Blacklist
         Log::info(' ProsByVatId Process! '.$vatId);
     if($response = (new ProsBlackListed())->find($vatId))
      {
         Log::info(' ProsByVatId Process = true '.$vatId);
         return $response;
      }
       Log::info(' ProsByVatId Process = false '.$vatId);
      // Search from Prospects
      if($response = (new Prospect())->getId($vatId))
       {
          Log::info(' Prospect Process = true '.$vatId);
          return $response;
       }
        Log::info(' Prospect Process = false '.$vatId);
      // Search from API

      if($response = (new Search())->perVatID($vatId))
      {
        Log::info(' Api Process = true '.$vatId);
        return $response;
      }
        Log::info('Done, no Vat Id Found');
      return 'Done, no Vat Id Found';
    }
}

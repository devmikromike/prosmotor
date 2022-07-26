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
         Log::info(' VatId has found from Blacklist '.$vatId);
         return $response;
      }
       Log::info(' VatId not found from Blacklist '.$vatId);
      // Search from Prospects
      if($response = (new Prospect())->getId($vatId))
       {
          Log::info(' VatId has found from  Prospect  '.$vatId);
          $response['status'] = 200;
          return $response;
       }
        Log::info('  VatId not found from  Prospect '.$vatId);
      // Search from API

      if($response = (new Search())->perVatID($vatId))
      {
        Log::info('  VatId not found from  Prospect - Continue with API request: '.$vatId);
        return $response;
      }
        Log::info('Done, no Vat Id Found: '.$vatId);
      return 'Done, no Vat Id Found';
    }
}

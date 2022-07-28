<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\SearchByVatId;
use App\Models\Prospect;
use App\Models\Proscounter;

class SearchController extends Controller
{
    public function perVatID($vatID)
    {


      if($response = (new prosByVatId())->search($vatID)){
          return $response;
        }else {
          return $response;
        }
      return "Server had bubuu!";
    }

    public function perName($name)
    {
      if($response = (new Search())->perName($name)){
          return $response;
        }else {
          return $response;
        }
      return "Server had bubuu!";
    }
    public function perDates($from, $to)
    {
        if($response = (new Search())->perDates($from, $to)){
            return $response;
          }else {
            return $response;
          }
        return "Server had bubuu!";
    }
    public function perPostalCode($code)
    {
        if($response = (new Search())->perPostalCode($code)){
            return $response;
          }else {
            return $response;
          }
        return "Server had bubuu!";
    }
    public function perPostalCodeWithBssCode($code, $bssCode)
    {
      //        dd($code, $bssCode);

      if($response = (new Search())->perPostalCodeWithBssCode($code, $bssCode)){
          return $response;
        }else {
          return $response;
        }
      return "Server had bubuu!";
    }
    public function howManyProspects()
    {
      $results = Prospect::CountPropects();
      return $results;  // int
    }
}

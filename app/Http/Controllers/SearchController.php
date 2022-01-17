<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;

class SearchController extends Controller
{

    


    public function perVatID($vatID)
    {
      if($response = Search::perVatID($vatID)){
          return $response;
        }else {
          return $response;
        }
      return "Server had bubuu!";
    }

    public function perName($name)
    {
      if($response = Search::perName($name)){
          return $response;
        }else {
          return $response;
        }
      return "Server had bubuu!";
    }
    public function perDates($from, $to)
    {
        if($response = Search::perDates($from, $to)){
            return $response;
          }else {
            return $response;
          }
        return "Server had bubuu!";
    }
}

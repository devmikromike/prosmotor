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
    public function total($codes, $results, $prosCities)
    {
      $codelist = [];
      $proslist = [];
      $codePerCity = [];
      $countsum = [];  // Counter Array
      $countsum['city'] = '';
      $i = 0;

  //   dump($prosCities);

      foreach ($prosCities['proslist'] as $items)
      {
        $countOfPerCityPros =  $items->count();

        foreach ($items as $item)
        {
          (int)$proscode = $item->bssCode;
          $proscity = $item->city;
    //  dump($item);

        //    dump((int)$proscode);
          foreach($codes as $key => $code)
          {

            if ($code['code'] === (int)$proscode)
            {
              foreach ($prosCities['citylist'] as $city)
              {
              //  dump((int)$proscode);

                if($city === $proscity )
                {
                  $proslist[] = $item;                
                }
              }
            }
          }
        }
      }
      return $proslist;

    } // end of function

/*
      foreach($codes as $key => $code)
      {
         $c = $code['code'];
         $codelist[] = $c;

        foreach($results as $pros)
        {
          $city  = $pros['city'];

          if(!$countsum['city'] === $city)
          {
              $countsum['city'] === $city;
          }

          $countsum[$city]['code']  = $c;
          $countsum[$city]['sum'] = 0;

          if ($c === (int)$pros['bssCode'])
          {
            $proslist[] = $pros;
            if ($countsum[$city]['code'] === $c )
            {
              $i++;
              $countsum[$city]['sum'] = $i;
            }

            if (!$countsum[$city]['code'] === $c)
            {
              $countsum[$city]['code'] = $c;
            }
              // if ($city === $countsum['city']  && $countsum[$city]['code'] === $c )

          }
        }
         $totalCodes = count($codelist);
          // dump($proslist, $countsum   );
      }  */




} // end of class

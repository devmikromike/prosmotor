<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

use App\Models\Location;
use App\Models\Proslist;
use App\Models\Proscounter;
use App\Models\Prospect;
use App\Models\CityList;
use App\Models\ProsBssLine;

class ProspectController extends Controller
{
  public $prospects;
  public $proslist;
  public $original = array();

    public function index(Request $request)
    {
        $cityList =  Arr::exists($request, 'cityList');
        $idsList =  Arr::exists($request, 'idsList');
        $results = [];
        $prosCodes =[];
        $proslist = [];
        $total = [];

        if ($cityList == 'true' && $idsList == 'true')
        {
           $cities = collect($request['cityList']);
           // return proslist per City as collection
           $prosCities = CityList::cityList($cities);
           $results =  Proslist::proscities($prosCities);
           // Business line codes
           $idsCodes  = $request['idsList'];
           $codes = ProsBssLine::codeList($idsCodes);
           $proslist = Proscounter::total($codes, $results, $prosCities);
 
           return view('prospect.index')->with([
        //     'totalproslist' => $results,
             'proslist' => $proslist,    // UI
             'bsscodes' => $codes,        // UI
             'totalcount' => $total,     /// UI
             'citylist' => $request->cityList,
           ]);
         } else {
           dd('miniminä pitää valita yksi kaupunki ja yksi toimiala');
         }
           // *********
          //  $perCity = Proscounter::countProsPerCity($results);
           //************
/*
           $count = [];
           $total = [];
           $proslist = [];
           $citylist = [];
           $countsum = [];  // Counter Array
           $c = '';
           $i = 0;
           $t = 0;
           $countsum = array( // Counter Array, reset
             'code' => $c,
             'total' => $t
           );
           foreach($codes as $key => $code)
           {
             $c = $code['code'];
             foreach($results as $pros)
             {
               if ($c === (int)$pros['bssCode'])
               {
                 $city  = $pros['city'];

                 $proslist[] = $pros;

                 if ($countsum['code'] === $c){
                    if(in_array( $pros['city'], $citylist ))
                    {
                      $counter = array(
                        'count' => 1
                      );
                      $count   = array(
                        'code' => $c,
                        'total' => count($counter)+1
                      );
                      $count['city'] = $city;

                      $total[] = array_merge($countsum, $count);


                    }else {$citylist[] = $city;
                      $counter = array(
                        'count' => 1
                      );
                    }

                 }else {
                   $counter = array(
                     'count' => 1
                   );
                   $countsum  = array(
                     'code' => $c,
                     'total' => count($counter),
                     'city' => $city,
                   );
              //      $total[] = array_merge($countsum, $counter);

                 }
               }else {}
             }
           }
*/

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
      //  Prospect Model
      $prospect = Prospect::find($id);
      $vatId = $prospect->vatId;
    //  $convert = str_replace('-','',$vatId);
    //  $vatId = (int)$convert;
    //  dd($vatId);
    //  Location Model
      $location = Location::where('vat_id', $vatId)
      ->where('type', 1)
      ->where('endDate', NULL)
      ->get();
      //  Contact Model - Pivot Contact_Prospect
      $contacts = $prospect ->contacts()->get();
      $contact = $contacts->toArray();

      return view('prospect.show',[
        'prospect' => $prospect,
        'location' => $location,
        'contacts' => $contact
      ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Prospect;
use App\Models\CityList;
use App\Models\ProsBssLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class ProspectController extends Controller
{
  public $prospects;
  public $proslist;
  public $original = array();

    public function index(Request $request)
    {
        $cityList =  Arr::exists($request, 'cityList');
        $idsList =  Arr::exists($request, 'idsList');

        if ($cityList == 'true' && $idsList == 'true')
        {
           $results = [];
           $prosCodes =[];
           $cities = collect($request['cityList']);
           $prosCities = CityList::cityList($cities);

          foreach ($prosCities['proslist'] as $prospects)
           { // for 'totalproslist'
             foreach ($prospects as $pros)
             {
               $vatId = $pros['vat_id'];
               $pros['name'] = Prospect::getName($vatId);
               // return code and nameFI in Array!
              (int)$pros['bssCode'] = Prospect::getBssCode($vatId);
               $results[] = $pros;
             }
           }
           $idsCodes  = $request['idsList'];
           $codes = ProsBssLine::codeList($idsCodes);
           $proslist = [];
           $countsum = [];
           $c;
           $countsum = array(
             'code' => $c;
            );
        //   $countsum['code'];

           foreach($codes as $key => $code)
           {
             $c = $code['code'];
             foreach($results as $pros)
             {
               if ($c === (int)$pros['bssCode'])
               {
                 $proslist[] = $pros;
                 $i;

                 if ($countsum['code'] === $c){
                   $i++;
                   $countsum  = array(
                     'code' => $c,
                     'total' => count($proslist) +$i,
                   );
                   dump($countsum);

                 }else {
                   $countsum  = array(
                     'code' => $c,
                     'total' => count($proslist)
                   );
                     dump($countsum);
                 }
                   dump($countsum);

            //     $count['code']['total'] = count($proslist);

               }else {
                }
             }
              $count = count($proslist);

              dump($count);
           }
          // $prosresult  = Prospect::bsslineCodes($codes);

          return view('prospect.index')->with([
            'totalproslist' => $results,
            'proslist' => $proslist,
            'bsscodes' => $codes,
        //    'totalcount' => $count
          ]);
        } else {
          dd('miniminä pitää valita yksi kaupunki ja yksi toimiala');
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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

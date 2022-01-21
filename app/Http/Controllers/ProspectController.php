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
  //dd($request);

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
               $pros['bssCode'] = Prospect::getBssCode($vatId);
               $results[] = $pros;
             }
           }
           $idsCodes  = collect($request['idsList']);
           $codes = ProsBssLine::codeList($idsCodes);
           $proslist  = Prospect::bsslineCodes($codes);
           dump($proslist);
          return view('prospect.index')->with([
            'totalproslist' => $results,
            'proslist' => $proslist,
            'bsscodes' => $codes
          ]);
        } else {
          dd('huuhaa false');
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

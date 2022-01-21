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
        $codeList =  Arr::exists($request, 'codeList');

        if ($cityList == 'true' && $codeList == 'true')
        {
           $cities = collect($request['cityList']);
           $prosCities = CityList::cityList($cities);
           $results = [];
          foreach ($prosCities['proslist'] as $prospects)
           {
             foreach ($prospects as $pros)
             {
               $vatId = $pros['vat_id'];
               $pros['name'] = Prospect::getNames($vatId);
               $results[] = $pros;
             }
           }
        $codes = collect($request['codeList']);
        $prosCodes = ProsBssLine::codeList($codes);

         

           return view('prospect.index')->with([
            'proslist' => $results,
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

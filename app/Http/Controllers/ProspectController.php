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

    //       dump('$prosCodes');
        dd($prosCodes);

           return view('prospect.index')->with([
            'proslist' => $results,
      //      'codes' => $prosCodes
          ]);
        } else {
          dd('huuhaa false');
        }

        dd($request);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

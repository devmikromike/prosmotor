<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Prospect;
use App\Models\CityList;
use App\Models\ProsBssLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProspectController extends Controller
{
    public function index(Request $request)
    {
        $cityList =  Arr::exists($request, 'cityList');
        $codeList =  Arr::exists($request, 'codeList');

        if ($cityList == 'true' && $codeList == 'true')
        {
           $cities = collect($request['cityList']);
           $prosCities = CityList::cityList($cities);
           $codes = collect($request['codeList']);
           $prosCodes = ProsBssLine::codeList($codes);

          return view('prospect.index')->with([
            'cities' => $prosCities,
            'codes' => $prosCodes
          ]);        
        } else {
          dd('huuhaa false');
        }

/*
        $cities = collect($request['cityList']);
        $codes = collect($request['cityList']);
        $sumCities = $cities->count();
        $sumCodes = $codes->count();
        dd($sumCities , $sumCodes);   */
/*
        if($sum === 1)
        {

        }
/*



/*
        if ($request->hasCities() > 0  &&  $request->hasCodes() > 0)
        {
            dd($request);
        } */


    //    dd(  $cityList, $codeList, $request);


      //$cityList = $request ->cityList;

      /*
      if ($request->hasCities() > 0  &&  $request->hasCodes() > 0)
      {
          dd($request);
      } */

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

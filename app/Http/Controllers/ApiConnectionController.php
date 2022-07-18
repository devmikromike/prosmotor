<?php

namespace App\Http\Controllers;

use App\Models\apiConnection;
use Illuminate\Http\Request;
use App\Models\Search;

class ApiConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($vatId)
    {
      dd($vatId);
      (new Search())->perVatID($vatId);
        return ('Done');
    }

    public function test()
    {
      // (new Search())->perVatID($vatId);
        return ('Api connectio OK!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\apiConnection  $apiConnection
     * @return \Illuminate\Http\Response
     */
    public function show(apiConnection $apiConnection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\apiConnection  $apiConnection
     * @return \Illuminate\Http\Response
     */
    public function edit(apiConnection $apiConnection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\apiConnection  $apiConnection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, apiConnection $apiConnection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\apiConnection  $apiConnection
     * @return \Illuminate\Http\Response
     */
    public function destroy(apiConnection $apiConnection)
    {
        //
    }
}

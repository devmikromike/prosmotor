<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityList;
use App\Models\ProsBssLine;

class HomeController extends Controller
{
 public function index()
 {
   $cityList = CityList::CityAll()->toArray();
   $codeList = ProsBssLine::CodeAll()->toArray();
  /*
   foreach($cityList as $city)
   {
    $id =   $city['id'];
    $name =   $city['name'];

     dd($id, $name);
   }   */




   return view('welcome',
   ['cityList' => $cityList,
    'codeList' => $codeList
  ]);
 }
}

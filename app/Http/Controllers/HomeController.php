<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityList;
use App\Models\ProsBssLine;

class HomeController extends Controller
{
 public function index()
 {
   return view('welcome');
 }
}

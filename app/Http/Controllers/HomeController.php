<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use App\Models\CityList;
use App\Models\ProsBssLine;

class HomeController extends Controller
{
   public function index()
   {
     return view('welcome');
   }
   public function config()
   {
     Artisan::call('cache:clear');
       \Artisan::call('settings:load-file');
          $value = Cache::get('settings');
     return $value;
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Models\CityList;
use App\Models\ProsBssLine;

class HomeController extends Controller
{
   public function index(Request $request)
   {

     if (!Session::isStarted()) {
       Session::start();
        
     }
/*
     $lang =  config('languages');
       App::setLocale( key($lang));
*/
     return view('welcome');
   }
   public function landing(Request $request)
   {
     if (!Session::isStarted()) {
       Session::start();

     }
     return view('landing');
   }
   public function config()
   {
     Artisan::call('cache:clear');
       \Artisan::call('settings:load-file');
          $value = Cache::get('settings');
     return $value;
   }
}

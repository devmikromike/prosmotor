<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProspectController;

//  Livevire Components
use App\Http\Livewire\BusinessCard;
use App\Http\Livewire\SearchByVatid;
use App\Http\Livewire\Landingpage;
//
// use

if (env('APP_ENV') === 'alpha')  {
  Route::get('/', function () {

      return view('welcome')->name('welcome');
  });
};

if (env('APP_ENV') === 'local')  {
 Route::get('/',[HomeController::class, 'landing'])->name('welcome');
  //  URL::forceSchema('https');
};

/*
Route::get('/', function () {

    return view('welcome');
}); */

Route::get('dev-login', function () {
    abort_unless(app()->environment('local'), 403);
    auth()->loginUsingId(App\Models\User::first());
    return redirect()->to('/');
});
Route::post('/contact', function (Request $request) {
      $contact = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'message' => 'required',
    ]);
    return back()->with('success_message', 'We received your message successfully and will get back to you shortly!');
});
 Route::get('/start/{vatID}',[SearchController::class, 'perVatID'])->name('start');

Route::get('/public',[HomeController::class, 'index'])->name('public');
// Route::get('/',[HomeController::class, 'landing'])->name('landingpage');
Route::get('/config',[HomeController::class, 'config'])->name('config');

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// Route::get('/prospect',[ProspectController::class,'list'])->name('public.list');
Route::post('/prospect',[ProspectController::class,'index'])->name('public.index');
Route::post('/prospect/{$id}/show',[ProspectController::class,'show'])->name('pros.show');

//Route::get('/SearchByPostal/{postalCode}/{bssCode}',[SearchController::class, 'perPostalAndBss'])->name('postalandbsscode');

Route::get('/SearchByVatID/{vatID}',[SearchController::class, 'perVatID'])->name('vatid');
Route::get('/SearchByName/{name}',[SearchController::class, 'perName'])->name('name');
Route::get('/SearchByDates/{from}/{to}',[SearchController::class, 'perDates'])->name('dates');
Route::get('/SearchByPostalCode/{code}',[SearchController::class, 'perPostalCode'])->name('postalcode');

Route::get('/SearchByPostalCode/{code}/{bssCode}',[SearchController::class, 'perPostalCodeWithBssCode'])->name('postalandbsscode');

Route::get('/countProspects',[SearchController::class, 'howManyProspects'])->name('howManyProspects');
//howManyProspects

/// Livewire component routes /////
Route::get('/search-by-id', SearchByVatid::class)->name('byVatId');
//Route::get('/businesscard/{pros_id}', BusinessCard::class)->name('businesscard');

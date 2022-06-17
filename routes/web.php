<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProspectController;

//  Livevire Components
use App\Http\Livewire\BusinessCard;
//
// use
/*
Route::get('/', function () {

    return view('welcome');
}); */
 /*
if (env('APP_ENV') === 'production')  {
    URL::forceSchema('https');
};
*/
Route::get('dev-login', function () {
    abort_unless(app()->environment('local'), 403);
    auth()->loginUsingId(App\Models\User::first());
    return redirect()->to('/');
});

Route::get('/',[HomeController::class, 'index'])->name('public');

Route::get('/config',[HomeController::class, 'config'])->name('config');


Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// Route::get('/prospect',[ProspectController::class,'list'])->name('public.list');
Route::post('/prospect',[ProspectController::class,'index'])->name('public.index');
Route::post('/prospect/{$id}/show',[ProspectController::class,'show'])->name('pros.show');

Route::get('/SearchByVatID/{vatID}',[SearchController::class, 'perVatID'])->name('vatid');
Route::get('/SearchByName/{name}',[SearchController::class, 'perName'])->name('name');
Route::get('/SearchByDates/{from}/{to}',[SearchController::class, 'perDates'])->name('dates');
Route::get('/SearchByPostalCode/{code}',[SearchController::class, 'perPostalCode'])->name('postalcode');
Route::get('/SearchByPostalCode/{code}/{bssCode}',[SearchController::class, 'perPostalCodeWithBssCode'])->name('postalandbsscode');
Route::get('/countProspects',[SearchController::class, 'howManyProspects'])->name('howManyProspects');
//howManyProspects
/// Livewire component routes /////

Route::get('/businesscard/{pros_id}', BusinessCard::class)->name('businesscard');

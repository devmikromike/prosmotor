<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProspectController;
// use
/*
Route::get('/', function () {

    return view('welcome');
}); */

Route::get('/',[HomeController::class, 'index'])->name('public');

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// Route::get('/prospect',[ProspectController::class,'list'])->name('public.list');
Route::post('/prospect',[ProspectController::class,'index'])->name('public.index');
Route::get('/prospect/{id}',[ProspectController::class,'show'])->name('pros.show');

Route::get('/SearchByVatID/{vatID}',[SearchController::class, 'perVatID'])->name('vatid');
Route::get('/SearchByName/{name}',[SearchController::class, 'perName'])->name('name');
Route::get('/SearchByDates/{from}/{to}',[SearchController::class, 'perDates'])->name('dates');

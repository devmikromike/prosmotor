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
Route::get('/prospect',[ProspectController::class,'list'])->name('public.list');
Route::post('/prospect',[ProspectController::class,'index'])->name('public.index');

Route::get('/SearchByVatID/{vatID}',[SearchController::class, 'perVatID'])->name('vatid');
Route::get('/SearchByName/{name}',[SearchController::class, 'perName'])->name('name');
Route::get('/SearchByDates/{from}/{to}',[SearchController::class, 'perDates'])->name('dates');

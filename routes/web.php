<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
// use

Route::get('/', function () {

    return view('welcome');
});

Route::get('/SearchByVatID/{vatID}',[SearchController::class, 'perVatID'])->name('vatid');
Route::get('/SearchByName/{name}',[SearchController::class, 'perName'])->name('name');
Route::get('/SearchByDates/{from}/{to}',[SearchController::class, 'perDates'])->name('dates');

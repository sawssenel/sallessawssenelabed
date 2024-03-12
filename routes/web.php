<?php

use Illuminate\Support\Facades\Route;

/*

| Web Routes

*/
Route::get('/{any}', function () {
    return view('layout.app');
    })->where('any', '.*');
    

/*Route::get('/', function () {
    return view('welcome');
});*/

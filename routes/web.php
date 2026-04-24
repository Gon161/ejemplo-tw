<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
 // return "Hola mundo desde laravel";
});
Route::get('/yair', function () {
  //  return view('welcome');
  return view('yair');
});


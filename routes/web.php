<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
 // return "Hola mundo desde laravel";
});


Route::get('/casita', function () {
    return view('inicio');
 // return "Hola mundo desde laravel";
})->name('home2');

Route::prefix('usuarios')->group(function () {
    Route::get('/',          [UsuarioController::class, 'index']);
    Route::post('/registro',         [UsuarioController::class, 'store']);
    Route::get('/{id}',      [UsuarioController::class, 'show']);
    Route::put('/{id}',      [UsuarioController::class, 'update']);
    Route::delete('/{id}',   [UsuarioController::class, 'destroy']);
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


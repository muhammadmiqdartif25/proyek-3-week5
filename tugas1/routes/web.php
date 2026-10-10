<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware(['guest'])->name('login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware(['guest'])->name('login.submit');

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::get('/logout', function(){
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
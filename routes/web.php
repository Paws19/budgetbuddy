<?php

use Illuminate\Support\Facades\Route;

//Landing page
Route::get('/', function () {
    return view('index');
})->name('index');
//Registration page
Route::get('/buddy-budget/registration', [App\Http\Controllers\Auth\AuthController::class, 'registration'])->name('registration');


//Dashboard page
Route::get('/dashboard', function () {
    return view('Homepage.dashboard');
})->name('dashboard');
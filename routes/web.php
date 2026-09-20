<?php

use Illuminate\Support\Facades\Route;

//Landing page
Route::get('/', function () {
    return view('index');
})->name('index');
//Login page
Route::get('/buddy-budget/login', [App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
//Login user
Route::post('/buddy-budget/login', [App\Http\Controllers\Auth\AuthController::class, 'loginUser'])->name('login.store');
//Registration page
Route::get('/buddy-budget/registration', [App\Http\Controllers\Auth\AuthController::class, 'registration'])->name('registration');
//Register user
Route::post('/buddy-budget/register', [App\Http\Controllers\Auth\AuthController::class, 'registerStore'])->name('register.store');
//Verify code
Route::post('/buddy-budget/verify', [App\Http\Controllers\Auth\AuthController::class, 'verifyCode'])->name('verify.code');

//Terms and Privacy page
Route::get('/buddy-budget/terms', function () {
    return view('policy.term');
})->name('terms');

Route::get('/buddy-budget/privacy', function () {
    return view('policy.privacy');
})->name('privacy');

Route::get('/email', function () {
    return view('smtp.verification');
})->name('email');


//Dashboard page
Route::get('/dashboard', function () {
    return view('Homepage.dashboard');
})->name('dashboard');


Route::post('/add-income', [App\Http\Controllers\Income\IncomeController::class, 'store'])->name('income.store');
Route::post('/add-expense', [App\Http\Controllers\Expense\ExpenseController::class, 'store'])->name('expense.store');
Route::post('/set-budget', [App\Http\Controllers\Budget\BudgetController::class, 'store'])->name('budget.store');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Income\IncomeController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Budget\BudgetController;

/*
|--------------------------------------------------------------------------
| Public pages (no login required)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/buddy-budget/terms', function () {
    return view('policy.term');
})->name('terms');

Route::get('/buddy-budget/privacy', function () {
    return view('policy.privacy');
})->name('privacy');

Route::get('/email', function () {
    return view('smtp.verification');
})->name('email');

/*
|--------------------------------------------------------------------------
| Guest only (must NOT be logged in)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/buddy-budget/login', [AuthController::class, 'login'])->name('login');
    Route::post('/buddy-budget/login', [AuthController::class, 'loginUser'])->name('login.store');

    // Registration
    Route::get('/buddy-budget/registration', [AuthController::class, 'registration'])->name('registration');
    Route::post('/buddy-budget/register', [AuthController::class, 'registerStore'])->name('register.store');

    // Verify code
    Route::post('/buddy-budget/verify', [AuthController::class, 'verifyCode'])->name('verify.code');
});

/*
|--------------------------------------------------------------------------
| Authenticated only (must be logged in)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/dashboard/reset', [DashboardController::class, 'reset'])->name('dashboard.reset');

    // Income
    Route::post('/add-income', [IncomeController::class, 'store'])->name('income.store');
    Route::put('/income/{id}', [IncomeController::class, 'update'])->name('income.update');
    Route::delete('/income/{id}', [IncomeController::class, 'destroy'])->name('income.destroy');

    // Expense
    Route::post('/add-expense', [ExpenseController::class, 'store'])->name('expense.store');
    Route::put('/expense/{id}', [ExpenseController::class, 'update'])->name('expense.update');
    Route::delete('/expense/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');

    // Budget
    Route::post('/set-budget', [BudgetController::class, 'store'])->name('budget.store');
    Route::put('/budget/{category}', [BudgetController::class, 'update'])->name('budget.update');
    Route::delete('/budget/{category}', [BudgetController::class, 'destroy'])->name('budget.destroy');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
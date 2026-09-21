<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Budget\SetBudgetModel as Budget;
use App\Models\Income\IncomeModel as Income;
use App\Models\Expense\ExpenseModel as Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;          
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    


public function index()
{
    $userId = auth()->id();
    $start  = Carbon::now()->startOfMonth()->toDateString();
    $end    = Carbon::now()->endOfMonth()->toDateString();

    // ========== INCOME ==========
    $income = Income::query()
        ->with('category')
        ->where('user_id', $userId)
        ->whereBetween('date', [$start, $end])
        ->orderByDesc('date')
        ->get()
        ->map(function ($row) {
            return [
                'id'     => $row->id,
                'name'   => $row->source,
                'cat'    => optional($row->category)->name ?? 'Other',
                'amount' => (float) $row->amount,
                'date'   => $row->date
                    ? Carbon::parse($row->date)->format('Y-m-d')
                    : null,
            ];
        });

    // ========== EXPENSES ==========
    $expenses = Expense::query()
        ->with('category')
        ->where('user_id', $userId)
        ->whereBetween('date', [$start, $end])
        ->orderByDesc('date')
        ->get()
        ->map(function ($row) {
            return [
                'id'     => $row->id,
                'name'   => $row->source,
                'cat'    => optional($row->category)->name ?? 'Other',
                'amount' => (float) $row->amount,
                'date'   => $row->date
                    ? Carbon::parse($row->date)->format('Y-m-d')
                    : null,
            ];
        });

    // ========== BUDGETS ==========
    $budgets = Budget::query()
        ->with('category')
        ->where('user_id', $userId)
        ->get()
        ->mapWithKeys(function ($row) {
            $catName = optional($row->category)->name ?? 'Other';
            return [$catName => (float) $row->monthly_limit];
        });

    $dashboardData = [
        'income'   => $income->values(),
        'expenses' => $expenses->values(),
        'budgets'  => $budgets,
    ];

    $incomeCategories  = \App\Models\Income\CategoryModel::orderBy('name')->get();
    $expenseCategories = \App\Models\Expense\ExpenseCategory::orderBy('name')->get();
    $budgetCategories  = \App\Models\Budget\BudgetCategory::orderBy('name')->get();

    return view('Homepage.dashboard', compact(
        'dashboardData',
        'incomeCategories',
        'expenseCategories',
        'budgetCategories'
    ));
}

    /**
     * Permanently delete ALL income, expenses, and budgets.
     * Called by the Reset button after user confirms.
     */
  public function reset(Request $request)
{
    $userId = auth()->id();

    // Delete only this user's records
    Income::where('user_id', $userId)->delete();
    Expense::where('user_id', $userId)->delete();
    Budget::where('user_id', $userId)->delete();

    return redirect()
        ->route('dashboard')
        ->with('success', 'All your income, expenses, and budgets have been deleted.');
}

}

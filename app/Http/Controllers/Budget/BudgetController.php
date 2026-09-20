<?php

namespace App\Http\Controllers\Budget;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget\BudgetCategory as BudgetCategoryModel;
use App\Models\Budget\SetBudgetModel;
use App\Models\Expense\ExpenseModel;
use Hamcrest\Core\Set;

class BudgetController extends Controller
{public function store(Request $request)
{
    $validated = $request->validate([
        'category'       => 'required|string|in:Food,Transport,Internet,Fun,Bills,Other',
        'other_category' => 'nullable|string|max:255',
        'amount_limit'   => 'required|numeric|min:100',
    ]);

    // 1. Find or create the category
    if ($validated['category'] === 'Other') {
        if (empty($validated['other_category'])) {
            return back()
                ->withErrors(['other_category' => 'Please specify the other category.'])
                ->withInput();
        }

        $category = BudgetCategoryModel::firstOrCreate([
            'name' => $validated['other_category'],
        ]);
    } else {
        $nameMap = [
            'Food'      => 'Food',
            'Transport' => 'Transport',
            'Internet'  => 'Internet',
            'Fun'       => 'Fun',
            'Bills'     => 'Bills',
        ];

        $category = BudgetCategoryModel::firstOrCreate([
            'name' => $nameMap[$validated['category']],
        ]);
    }

    // 2. Create or update the budget for this category
    SetBudgetModel::updateOrCreate(
        [
            'category_id' => $category->id,
            // 'user_id' => auth()->id(), // uncomment if you have users
        ],
        [
            'monthly_limit' => $validated['amount_limit'],
        ]
    );

    return redirect()
        ->route('dashboard')
        ->with('success', 'Budget updated successfully!');
}
}

<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense\ExpenseModel;
use App\Models\Expense\ExpenseCategory;

class ExpenseController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'description_spent'     => 'required|string|max:255',
        'amount_spent'          => 'required|numeric|min:0.01',
        'date_spent'            => 'required|date',
        'category_spent'        => 'required|string|in:Food,Transport,Internet,Fun,Bills,Other',
        'other_category_spent'  => 'nullable|string|max:255',
    ]);

    // Handle category
    if ($validated['category_spent'] === 'Other') {
        if (empty($validated['other_category_spent'])) {
            return back()
                ->withErrors(['other_category_spent' => 'Please specify the other category.'])
                ->withInput();
        }

        $category = ExpenseCategory::firstOrCreate([
            'name' => $validated['other_category_spent'],
        ]);
    } else {
        $nameMap = [
            'Food'      => 'Food',
            'Transport' => 'Transport',
            'Internet'  => 'Internet',
            'Fun'       => 'Fun',
            'Bills'     => 'Bills',
        ];

        $category = ExpenseCategory::firstOrCreate([
            'name' => $nameMap[$validated['category_spent']],
        ]);
    }

    ExpenseModel::create([
        'source' => $validated['description_spent'],
        'amount'      => $validated['amount_spent'],
        'date'        => $validated['date_spent'],
        'category_id' => $category->id,
        // 'user_id'  => auth()->id(), // uncomment if needed
    ]);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Expense added successfully!');
}
}

<?php

namespace App\Http\Controllers\Budget;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget\BudgetCategory as BudgetCategoryModel;
use App\Models\Budget\SetBudgetModel;
use App\Models\Expense\ExpenseModel;
use Hamcrest\Core\Set;

class BudgetController extends Controller
{
     public function store(Request $request)
    {
        $rules = [
            'category_id'    => 'required',
            'monthly_limit'  => 'required|numeric|min:100',
            'other_category' => 'nullable|string|max:100',
        ];

        if ($request->category_id === 'other') {
            $rules['other_category'] = 'required|string|max:100';
        } else {
            $rules['category_id'] = 'required|exists:budget_categories,id';
        }

        $validated = $request->validate($rules);

        if ($validated['category_id'] === 'other') {
            $cat = BudgetCategoryModel::firstOrCreate(
                ['name' => trim($validated['other_category'])]
            );
            $categoryId = $cat->id;
        } else {
            $categoryId = $validated['category_id'];
        }

        SetBudgetModel::updateOrCreate(
            ['category_id' => $categoryId],
            ['monthly_limit' => $validated['monthly_limit']]
        );

        return redirect()->route('dashboard')->with('success', 'Budget saved!');
    }

    public function update(Request $request, $category)
{
    // $category can be the category name or ID depending on how you pass it from the frontend
    // In the frontend we sent the category name, so we find by name first

    $rules = [
        'monthly_limit' => 'required|numeric|min:100',
    ];

    $validated = $request->validate($rules);

    // Find the category (by name, since frontend sends the name)
    $cat = BudgetCategoryModel::where('name', $category)->first();

    if (!$cat) {
        return redirect()->route('dashboard')->with('error', 'Category not found.');
    }

    // Update the budget limit
    SetBudgetModel::updateOrCreate(
        ['category_id' => $cat->id],
        ['monthly_limit' => $validated['monthly_limit']]
    );

    return redirect()->route('dashboard')->with('success', 'Budget updated successfully!');
}

public function destroy($category)
{
    // Find the category by name
    $cat = BudgetCategoryModel::where('name', $category)->first();

    if (!$cat) {
        return redirect()->route('dashboard')->with('error', 'Category not found.');
    }

    // Delete the budget limit for this category
    SetBudgetModel::where('category_id', $cat->id)->delete();

    return redirect()->route('dashboard')->with('success', 'Budget deleted successfully!');
}
}

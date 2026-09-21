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
    $rules = [
        'source'         => 'required|string|max:255',
        'amount'         => 'required|numeric|min:0.01',
        'date'           => 'required|date',
        'category_id'    => 'required',
        'other_category' => 'nullable|string|max:100',
    ];

    if ($request->category_id === 'other') {
        $rules['other_category'] = 'required|string|max:100';
    } else {
        $rules['category_id'] = 'required|exists:expense_categories,id';
    }

    $validated = $request->validate($rules);

    if ($validated['category_id'] === 'other') {
        $cat = ExpenseCategory::firstOrCreate(
            ['name' => trim($validated['other_category'])]
        );
        $categoryId = $cat->id;
    } else {
        $categoryId = $validated['category_id'];
    }

    ExpenseModel::create([
        'user_id'     => auth()->id(),   // ← current logged-in user
        'category_id' => $categoryId,
        'source'      => $validated['source'],
        'amount'      => $validated['amount'],
        'date'        => $validated['date'],
    ]);

    return redirect()->route('dashboard')->with('success', 'Expense saved!');
}

    public function update(Request $request, $id)
{
    $expense = ExpenseModel::findOrFail($id);

    $rules = [
        'source'         => 'required|string|max:255',
        'amount'         => 'required|numeric|min:0.01',
        'date'           => 'required|date',
        'category_id'    => 'required',
        'other_category' => 'nullable|string|max:100',
    ];

    if ($request->category_id === 'other') {
        $rules['other_category'] = 'required|string|max:100';
    } else {
        $rules['category_id'] = 'required|exists:expense_categories,id';
    }

    $validated = $request->validate($rules);

    if ($validated['category_id'] === 'other') {
        $cat = ExpenseCategory::firstOrCreate(
            ['name' => trim($validated['other_category'])]
        );
        $categoryId = $cat->id;
    } else {
        $categoryId = $validated['category_id'];
    }

    $expense->update([
        'category_id' => $categoryId,
        'source'      => $validated['source'],
        'amount'      => $validated['amount'],
        'date'        => $validated['date'],
    ]);

    return redirect()->route('dashboard')->with('success', 'Expense updated successfully!');
}


public function destroy($id)
{
    $expense = ExpenseModel::findOrFail($id);
    $expense->delete();

    return redirect()->route('dashboard')->with('success', 'Expense deleted successfully!');
}
}

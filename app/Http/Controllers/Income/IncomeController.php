<?php

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income\IncomeModel;
use App\Models\Income\CategoryModel as IncomeCategoryModel;

class IncomeController extends Controller
{
public function store(Request $request)
{
    $validated = $request->validate([
        'source'         => 'required|string|max:255',
        'amount'         => 'required|numeric|min:0.01',
        'date_received'  => 'required|date',
        'description'    => 'nullable|string|max:1000',
        'category'       => 'required|string|in:Work,Side_Hustle,Gift,Other',
        'other_category' => 'nullable|string|max:255',
    ]);

    // Handle category
    if ($validated['category'] === 'Other') {
        if (empty($validated['other_category'])) {
            return back()
                ->withErrors(['other_category' => 'Please specify the other category.'])
                ->withInput();
        }

        $category = IncomeCategoryModel::firstOrCreate([
            'name' => $validated['other_category'],
        ]);
    } else {
        // Map the form values to real category names
        $nameMap = [
            'Work'        => 'Work',
            'Side_Hustle' => 'Side hustle',
            'Gift'        => 'Gift',
        ];

        $category = IncomeCategoryModel::firstOrCreate([
            'name' => $nameMap[$validated['category']],
        ]);
    }

    // Save the income
    IncomeModel::create([
        'category_id'   => $category->id,
        'source'        => $validated['source'],
        'amount'        => $validated['amount'],
        'date' => $validated['date_received'],
        'description'   => $validated['description'] ?? null,
    ]);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Income added successfully.');
}
}

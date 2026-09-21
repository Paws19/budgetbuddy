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
        $rules = [
            'source'         => 'required|string|max:255',
            'amount'         => 'required|numeric|min:0.01',
            'date'           => 'required|date',
            'description'    => 'nullable|string|max:500',
            'category_id'    => 'required',
            'other_category' => 'nullable|string|max:100',
        ];

        if ($request->category_id === 'other') {
            $rules['other_category'] = 'required|string|max:100';
        } else {
            $rules['category_id'] = 'required|exists:income_categories,id';
        }

        $validated = $request->validate($rules);

        if ($validated['category_id'] === 'other') {
            $cat = IncomeCategoryModel::firstOrCreate(
                ['name' => trim($validated['other_category'])]
            );
            $categoryId = $cat->id;
        } else {
            $categoryId = $validated['category_id'];
        }

        IncomeModel::create([
            'category_id' => $categoryId,
            'source'      => $validated['source'],
            'amount'      => $validated['amount'],
            'date'        => $validated['date'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Income saved!');
    }

    public function update(Request $request, $id)
{
    $income = IncomeModel::findOrFail($id);

    $rules = [
        'source'         => 'required|string|max:255',
        'amount'         => 'required|numeric|min:0.01',
        'date'           => 'required|date',
        'description'    => 'nullable|string|max:500',
        'category_id'    => 'required',
        'other_category' => 'nullable|string|max:100',
    ];

    if ($request->category_id === 'other') {
        $rules['other_category'] = 'required|string|max:100';
    } else {
        $rules['category_id'] = 'required|exists:income_categories,id';
    }

    $validated = $request->validate($rules);

    if ($validated['category_id'] === 'other') {
        $cat = IncomeCategoryModel::firstOrCreate(
            ['name' => trim($validated['other_category'])]
        );
        $categoryId = $cat->id;
    } else {
        $categoryId = $validated['category_id'];
    }

    $income->update([
        'category_id' => $categoryId,
        'source'      => $validated['source'],
        'amount'      => $validated['amount'],
        'date'        => $validated['date'],
        'description' => $validated['description'] ?? null,
    ]);

    return redirect()->route('dashboard')->with('success', 'Income updated successfully!');
}

public function destroy($id)
{
    $income = IncomeModel::findOrFail($id);
    $income->delete();

    return redirect()->route('dashboard')->with('success', 'Income deleted successfully!');
}
}

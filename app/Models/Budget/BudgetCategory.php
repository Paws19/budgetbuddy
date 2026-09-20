<?php

namespace App\Models\Budget;

use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    protected $table = 'budget_categories';

    protected $fillable = [
        'name',
    ];

    public function budget()
    {
        return $this->hasMany(SetBudgetModel::class, 'category_id');
    }
}

<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table = 'expense_categories';

    protected $fillable = [
        'name',
    ];

    public function expenses()
    {
        return $this->hasMany(ExpenseModel::class, 'category_id');
    }
}

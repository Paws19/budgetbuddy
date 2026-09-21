<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Model;
use App\Models\Expense\ExpenseCategory;

class ExpenseModel extends Model
{
    protected $table = 'expense';

    protected $fillable = [
        'category_id',
        'user_id',
        'source',
        'amount',
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }
}

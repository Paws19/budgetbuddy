<?php

namespace App\Models\Budget;

use Illuminate\Database\Eloquent\Model;

class SetBudgetModel extends Model
{
    protected $table = 'budget';

    protected $fillable = [
        'category_id',
        'user_id',
        'monthly_limit',
    ];

    public function category()
    {
        return $this->belongsTo(BudgetCategory::class, 'category_id');
    }
}

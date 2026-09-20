<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Model;
use App\Models\Income\IncomeModel;

class CategoryModel extends Model
{
    protected $table = 'income_categories';

    protected $fillable = [
        'name',
    ];

    public function incomes()
    {
        return $this->hasMany(IncomeModel::class);
    }
}

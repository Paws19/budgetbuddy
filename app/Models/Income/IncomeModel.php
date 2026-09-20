<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Model;
use App\Models\Income\CategoryModel as IncomeCategoryModel;

class IncomeModel extends Model
{
    protected $table = 'income';

    protected $fillable = [
        'category_id',
        'source',
        'amount',
        'date',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(IncomeCategoryModel::class, 'category_id');
    }
}

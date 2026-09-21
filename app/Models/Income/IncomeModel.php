<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Model;
use App\Models\Income\CategoryModel;

class IncomeModel extends Model
{
    protected $table = 'income';

    protected $fillable = [
        'category_id',
        'user_id',
        'source',
        'amount',
        'date',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}

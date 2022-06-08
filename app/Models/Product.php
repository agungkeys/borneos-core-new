<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = ['id',
                        'name',
                        'category_id',
                        'merchant_id',
                        'price'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}

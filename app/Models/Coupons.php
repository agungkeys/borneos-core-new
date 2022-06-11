<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Coupons extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title', 'coupon_type', 'merchant_id', 'code', 'limit_same_user', 'date_start', 'date_end', 'discount_type', 'discount', 'max_discount', 'min_purchase', 'status'
    ];

    public $sortable = [
        'id', 'title', 'code', 'date_start', 'date_end', 'discount', 'max_discount'
    ];
}

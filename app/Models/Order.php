<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Order extends Model
{
    use HasFactory, Sortable;

    protected $table = 'orders';

    public $sortable = [
        'id', 'merchant_id', 'customer_name', 'customer_telp', 'order_type', 'customer_address',
        'customer_notes', 'total_item', 'total_item_price', 'total_distance_price', 'total_price',
        'payment_type', 'payment_status'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
}

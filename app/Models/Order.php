<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Order extends Model
{
    use HasFactory, Sortable;

    protected $table = 'orders';

    protected $fillable = [
        'prefix', 'merchant_id', 'customer_name', 'customer_telp', 'order_type', 'customer_address',
        'customer_address_lat', 'customer_address_lang', 'distance', 'courier_id',
        'customer_notes', 'total_item', 'total_item_price', 'total_distance_price', 'total_price',
        'payment_id', 'payment_type', 'payment_total', 'payment_bank_name', 'payment_account_number', 'payment_status',
        'status', 'status_notes'
    ];

    public $sortable = [
        'id', 'merchant_id', 'customer_name', 'customer_telp', 'order_type', 'customer_address',
        'customer_notes', 'total_item', 'total_item_price', 'total_distance_price', 'total_price',
        'payment_type', 'payment_status', 'status'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $fillable = [
         'category_id', 'category_ids', 'categories_id', 'categories_ids', 'merchant_type', 'name', 'slug','phone', 'email', 'logo', 'additional_image', 'latitude', 'longitude', 'district', 'address', 'minimum_order', 'comission', 'schedule_order', 'status', 'vendor_id', 'free_delivery', 'delivery', 'cover_photo', 'take_away', 'food_section', 'tax', 'review_section', 'active', 'self_delivery_system', 'pos_system', 'cash_on_delivery'
    ];
}

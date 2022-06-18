<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Merchant extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'category_id', 'category_ids', 'categories_id', 'categories_ids', 'merchant_type', 'name', 'slug', 'phone', 'email', 'logo', 'additional_image', 'latitude', 'longitude', 'district', 'address', 'footer_text', 'minimum_order', 'comission', 'schedule_order', 'opening_time', 'closeing_time', 'status', 'vendor_id', 'free_delivery', 'rating', 'cover_photo', 'delivery', 'delivery_time', 'take_away', 'food_section', 'tax', 'review_section', 'active', 'off_day', 'gst', 'self_delivery_system', 'pos_system', 'cash_on_delivery'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class General extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title', 'description', 'logo', 'logo_additional', 'address', 'address_lat', 'address_lng', 'phone', 'email', 'footer_text', 'seo_title', 'seo_description', 'seo_author', 'seo_keywords', 'seo_image', 'seo_image_additional', 'seo_twitter_link', 'seo_facebook_link', 'maintenance_mode', 'min_delivery_charge', 'min_charge_km', 'delivery_charge_per_km'
    ];

    public $sortable = [
        'id', 'title'
    ];
}

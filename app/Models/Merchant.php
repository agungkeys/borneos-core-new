<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Merchant extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = [
        'id', 'name', 'phone', 'merchant_favorite', 'status'
    ];

    protected $fillable = [
        'category_id', 'category_ids', 'categories_id', 'categories_ids', 'merchant_type', 'paid_partnership',
        'name', 'slug', 'phone', 'email', 'logo', 'additional_image', 'latitude', 'longitude', 'district',
        'address', 'footer_text', 'minimum_order', 'comission', 'schedule_order', 'opening_time', 'closeing_time',
        'status', 'vendor_id', 'free_delivery', 'rating', 'cover_photo', 'delivery', 'delivery_time', 'take_away',
        'food_section', 'tax', 'review_section', 'active', 'off_day', 'gst', 'self_delivery_system', 'pos_system',
        'cash_on_delivery', 'seo_image', 'additional_seo_image'
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
    public function compressLogo($setSize)
    {
        if ($this->additional_image) {
            $convert = json_decode($this->additional_image);
            if ($convert && $convert->logo) {
                $public_image_host_cloudinary = env('PUBLIC_IMAGE_HOST_CLOUDINARY');
                $public_cloudinary_id = env('PUBLIC_CLOUDINARY_ID');
                $public_id = $convert->logo->public_id;
                $link = "$public_image_host_cloudinary $setSize,c_fill/ $public_cloudinary_id $public_id.webp";
                return str_replace(' ', '', $link);
            } else {
                return env('PUBLIC_IMAGE_EMPTY');
            }
        } else {
            return env('PUBLIC_IMAGE_EMPTY');
        }
    }
    public function compressCover($setSize)
    {
        if ($this->additional_image) {
            $convert = json_decode($this->additional_image);
            if ($convert && $convert->cover) {
                $public_image_host_cloudinary = env('PUBLIC_IMAGE_HOST_CLOUDINARY');
                $public_cloudinary_id = env('PUBLIC_CLOUDINARY_ID');
                $public_id = $convert->cover->public_id;
                $link = "$public_image_host_cloudinary $setSize,c_fill/ $public_cloudinary_id $public_id.webp";
                return str_replace(' ', '', $link);
            } else {
                return env('PUBLIC_IMAGE_EMPTY');
            }
        } else {
            return env('PUBLIC_IMAGE_EMPTY');
        }
    }
    public function compressSeoImage($setSize)
    {
        if ($this->additional_seo_image) {
            $convert = json_decode($this->additional_seo_image);
            if ($convert && $convert->public_id) {
                $public_image_host_cloudinary = env('PUBLIC_IMAGE_HOST_CLOUDINARY');
                $public_cloudinary_id = env('PUBLIC_CLOUDINARY_ID');
                $public_id = $convert->public_id;
                $link = "$public_image_host_cloudinary $setSize,c_fill/ $public_cloudinary_id $public_id.webp";
                return str_replace(' ', '', $link);
            } else {
                return env('PUBLIC_IMAGE_EMPTY');
            }
        } else {
            return env('PUBLIC_IMAGE_EMPTY');
        }
    }
}

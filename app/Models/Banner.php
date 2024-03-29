<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Banner extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'banners';

    protected $fillable = [
        'title', 'type', 'image', 'additional_image', 'url', 'status', 'merchant_id', 'admin_id'
    ];

    public $sortable = [
        'title', 'type', 'url'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function compressImage($setSize)
    {
        if ($this->additional_image) {
            $convert = json_decode($this->additional_image);
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

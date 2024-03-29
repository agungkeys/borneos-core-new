<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MerchantGroup extends Model
{
    use HasFactory, Sortable;
    protected $table = 'merchant-groups';
    protected $fillable = [
        'name','slug','flat_delivery','image','additional_image'
    ];
    public $sortable = [
        'id', 'name', 'slug','flat_delivery'
    ];

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

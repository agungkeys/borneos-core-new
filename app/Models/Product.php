<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = [
        'id',
        'name',
        'category_id',
        'merchant_id',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
    public function sub_category($id)
    {
        $categories = Category::where(['id' => $id])->get('name');
        foreach ($categories as $category) {
            return $category->name;
        };
    }
    public function sub_sub_category($id)
    {
        return $this->sub_category($id);
    }
    public function SubCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
    public function SubSubCategory()
    {
        return $this->belongsTo(Category::class, 'sub_sub_category_id');
    }
    public function compressImage($setSize)
    {
        if ($this->additional_image) {
            $convert = json_decode($this->additional_image);
            if ($convert->public_id) {
                $public_image_host_cloudinary = env('PUBLIC_IMAGE_HOST_CLOUDINARY');
                $public_cloudinary_id = env('PUBLIC_CLOUDINARY_ID');
                $public_id = $convert->public_id;
                $link = "$public_image_host_cloudinary $setSize,c_fill/ $public_cloudinary_id $public_id.webp";
                return str_replace(' ', '', $link);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}

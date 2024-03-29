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
        'price',
        'favorite',
        'status'
    ];
    protected $fillable = [
        'merchant_id', 'name', 'slug','short_description','description', 'image', 'additional_image', 'category_id', 'sub_category_id',
        'sub_sub_category_id', 'category_ids', 'variations', 'add_ons', 'attributes', 'choice_options', 'price', 'tax',
        'tax_type', 'discount', 'discount_type', 'available_time_starts', 'available_time_ends', 'set_menu', 'favorite', 'status', 'order_count'
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
                return env('PUBLIC_IMAGE_EMPTY');
            }
        } else {
            return env('PUBLIC_IMAGE_EMPTY');
        }
    }
}

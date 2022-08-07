<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Blog extends Model
{
    use HasFactory, Sortable;
    protected $table = 'blog';
    public $sortable = [
        'name', 'slug'
    ];
    protected $fillable = [
        'user_id', 'blog_category_id', 'title', 'slug', 'image', 'additional_image', 'short_details', 'details', 'status'
    ];

    public function blog_category()
    {
        return $this->belongsTo(CategoryBlog::class, 'blog_category_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}

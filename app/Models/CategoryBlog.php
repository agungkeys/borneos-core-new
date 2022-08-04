<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class CategoryBlog extends Model
{
    use HasFactory, Sortable;
    protected $table = 'category_blog';
    public $sortable = [
        'name', 'slug'
    ];
    protected $fillable = [
        'name', 'slug', 'image', 'additional_image', 'status'
    ];
}

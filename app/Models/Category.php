<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = [
        'id', 'name', 'slug', 'priority'
    ];
    protected $fillable = [
        'name', 'slug', 'image', 'additional_image', 'parent_id', 'position', 'priority', 'status'
    ];

    public function CategoryNameFromSubCategory()
    {
        $categories = Category::where(['id' => $this->parent_id])->get('name');
        foreach ($categories as $category) {
            return $category->name;
        };
    }
    public function CategoryNameFromSubSubCategory()
    {
        return $this->CategoryNameFromSubCategory();
    }
}

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
        'id', 'name', 'slug'
    ];
    protected $fillable = [
        'name', 'slug', 'image', 'additional_image', 'parent_id', 'position', 'priority', 'status'
    ];
}

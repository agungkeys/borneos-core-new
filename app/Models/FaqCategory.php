<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class FaqCategory extends Model
{
    use HasFactory,Sortable;
    protected $table = 'category_faq';
    public $sortable = [
        'id','title', 'description'
    ];
    protected $fillable = [
        'title','description','image','additional_image'
    ];
}

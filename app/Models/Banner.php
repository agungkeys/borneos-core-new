<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Banner extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title','type', 'image', 'url', 'status', 'merchant_id', 'admin_id'
    ];

    public $sortable = [
        'id','title', 'url'
    ];
}

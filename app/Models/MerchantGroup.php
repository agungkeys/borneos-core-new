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

}

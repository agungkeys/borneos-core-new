<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Courier extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name', 'phone', 'address', 'address_lat', 'address_lang', 'identity_type', 'identity_no', 'identity_expired', 'identity_image', 'identity_additional_image', 'profile_image', 'profile_additional_image', 'badge', 'status', 'join_date'
    ];

    public $sortable = [
        'id', 'name', 'phone', 'status', 'join_date'
    ];
}

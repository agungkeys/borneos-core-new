<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Courier extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Sortable;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'name', 'phone', 'address', 'email', 'password', 'address_lat', 'address_lang', 'identity_type', 'identity_no', 'identity_expired', 'identity_image', 'identity_additional_image', 'profile_image', 'profile_additional_image', 'badge', 'status', 'join_date'
    ];

    public $sortable = [
        'id', 'name', 'phone', 'status', 'join_date'
    ];
}

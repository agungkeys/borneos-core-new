<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Admin extends Authenticatable
{
    // use HasFactory;
    use HasFactory;
    use Sortable;
    protected $table = 'admins';
    protected $fillable = [
        'f_name', 'l_name', 'phone', 'email', 'image', 'additional_image', 'password', 'role_id', 'status'
    ];

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }

    public function AdminName()
    {
        return "$this->f_name $this->l_name";
    }
}

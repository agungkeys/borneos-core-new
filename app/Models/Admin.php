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

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }
}

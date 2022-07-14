<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class LogOrder extends Model
{

    use HasFactory, Sortable;

    protected $table = 'log';

    public $sortable = [
        'prefix', 'method', 'method_detail', 'value', 'deskription', 'user', 'user_type'
    ];
}

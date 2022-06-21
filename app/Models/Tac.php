<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Tac extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title', 'description', 'description', 'image', 'position', 'type', 'status'
    ];

    public $sortable = [
        'id', 'title'
    ];
}
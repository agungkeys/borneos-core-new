<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PrivacyPolicy extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title', 'description', 'image', 'position', 'type', 'status'
    ];

    public $sortable = [
        'id', 'title'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Payment extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['name', 'type', 'account_name', 'account_no', 'image', 'additional_image', 'status'];

    public $sortable = ['id', 'name', 'account_name', 'account_no'];
}

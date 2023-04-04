<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Travel extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'travels';

    protected $fillable = ['prefix', 'fullname', 'telp', 'full_address', 'sub_district', 'district', 'route', 'seat_no', 'url_idcard', 'url_idvaccine', 'approved_at'];

    public $sortable = [
        'id', 'seat_no', 'district', 'sub_district'
    ];
}

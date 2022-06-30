<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Faq extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'merchant_id', 'title', 'description', 'image', 'position', 'type', 'status'
    ];

    public $sortable = [
        'id', 'merchant_id', 'title'
    ];

    public function merchantName($id)
    {
        $merchants = Merchant::select('name')->where('id', $id)->get();
        foreach ($merchants as $merchant) {
            return $merchant->name;
        }
    }
}

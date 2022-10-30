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
        'merchant_id','category_faq_id','title', 'description', 'image', 'position', 'type', 'status'
    ];

    public $sortable = [
        'id', 'merchant_id', 'title'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class,'merchant_id');
    }

    public function category()
    {
        return $this->belongsTo(FaqCategory::class,'category_faq_id');
    }

    public function merchantName($id)
    {
        $merchants = Merchant::select('name')->where('id', $id)->get();
        foreach ($merchants as $merchant) {
            return $merchant->name;
        }
    }
}

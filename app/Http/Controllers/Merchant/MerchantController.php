<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MerchantController extends Controller
{
 public function master_merchant_edit($id)
    {
        $master_merchant = Merchant::find($id);
        return view(merchant.merchant.edit', [
            'master_merchant' => Merchant::find($id),
            'master_merchant_vendor' => Vendor::where('id', $master_merchant->vendor_id)->first(),
            'categories_position_0' => Category::where('position', 0)->get(),
            'categories_position_1' => Category::where('position', 1)->where('parent_id',$master_merchant->category_id)->get()
        ]);
    }
}
?>
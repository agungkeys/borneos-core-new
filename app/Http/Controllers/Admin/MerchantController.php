<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function master_merchant_index(){
        // $master_merchants = Merchant::all();
        $master_merchants = Merchant::join('vendors', 'merchants.vendor_id', '=', 'vendors.id')->get();
        return view('admin.merchant.index', compact('master_merchants'));
    }
    public function master_merchant_add(){
        $main_categories = Category::where(['position' => 0 ])->get();
        return view('admin.merchant.add', compact('main_categories'));
    }
}

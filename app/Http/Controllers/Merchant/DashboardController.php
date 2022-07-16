<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\{Merchant, Order};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function dashboard(Request $request)
  {
    $merchant   = Merchant::where(['vendor_id' => Auth()->id()])->get();
    $orderCount = (object)[
      'new'        => Order::where(['merchant_id' => $merchant[0]->id, 'status' => 'new'])->count(),
      'processing' => Order::where(['merchant_id' => $merchant[0]->id, 'status' => 'processing'])->count(),
      'otw'        => Order::where(['merchant_id' => $merchant[0]->id, 'status' => 'otw'])->count(),
      'delivered'  => Order::where(['merchant_id' => $merchant[0]->id, 'status' => 'delivered'])->count(),
      'cancel'     => Order::where(['merchant_id' => $merchant[0]->id, 'status' => 'cancel'])->count(),
      'all'        => Order::where(['merchant_id' => $merchant[0]->id])->count()
    ];
    return view('merchant.dashboard', compact('merchant', 'orderCount'));
  }
}

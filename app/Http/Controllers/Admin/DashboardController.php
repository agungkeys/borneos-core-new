<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function dashboard(Request $request)
  {
    $ordersCount = (object)[
      'new'        => Order::where(['status' => 'new'])->count(),
      'processing' => Order::where(['status' => 'processing'])->count(),
      'otw'        => Order::where(['status' => 'otw'])->count(),
      'delivered'  => Order::where(['status' => 'delivered'])->count(),
      'cancel'     => Order::where(['status' => 'cancel'])->count(),
      'all'        => Order::count()
    ];
    return view('admin.dashboard', compact('ordersCount'));
  }
}

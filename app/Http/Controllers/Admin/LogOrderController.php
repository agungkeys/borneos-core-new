<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogOrder;
use Illuminate\Http\Request;

class LogOrderController extends Controller
{
  public function index(Request $request)
  {
    $filter = $request->query('filter');
    if (!empty($filter)) {
      $order_logs = LogOrder::sortable()
        ->where('log.prefix', 'like', '%' . $filter . '%')
        ->orWhere('log.method', 'like', '%' . $filter . '%')
        ->orWhere('log.method_detail', 'like', '%' . $filter . '%')
        ->orWhere('log.value', 'like', '%' . $filter . '%')
        ->orWhere('log.user', 'like', '%' . $filter . '%')
        ->orWhere('log.user_type', 'like', '%' . $filter . '%')
        ->paginate(10);
    } else {
      $order_logs = LogOrder::sortable()->paginate(10);
    }
    return view('admin.log.order.index', compact('order_logs', 'filter'));
  }
}

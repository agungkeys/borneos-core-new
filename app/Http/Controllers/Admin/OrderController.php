<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request, $status)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $orders = Order::sortable()
                ->where('orders.customer_name', 'like', '%' . $filter . '%')
                ->orWhere('orders.id', 'like', '%' . $filter . '%')
                ->orWhere('orders.order_type', 'like', '%' . $filter . '%')
                ->orWhere('orders.customer_telp', 'like', '%' . $filter . '%')
                ->orWhere('orders.customer_address', 'like', '%' . $filter . '%')
                ->orWhere('orders.customer_notes', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_item', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_item_price', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_distance_price', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_price', 'like', '%' . $filter . '%')
                ->orWhere('orders.payment_type', 'like', '%' . $filter . '%')
                ->orWhere('orders.payment_status', 'like', '%' . $filter . '%')
                ->orWhere('orders.status', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $orders = Order::sortable()->where('orders.status', 'like', '%' . $status . '%')->paginate(10);
        }
        return view('admin.orders.index', compact('orders', 'filter'));
    }

    public function all(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $orders = Order::sortable()
                ->where('orders.customer_name', 'like', '%' . $filter . '%')
                ->orWhere('orders.id', 'like', '%' . $filter . '%')
                ->orWhere('orders.order_type', 'like', '%' . $filter . '%')
                ->orWhere('orders.customer_telp', 'like', '%' . $filter . '%')
                ->orWhere('orders.customer_address', 'like', '%' . $filter . '%')
                ->orWhere('orders.customer_notes', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_item', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_item_price', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_distance_price', 'like', '%' . $filter . '%')
                ->orWhere('orders.total_price', 'like', '%' . $filter . '%')
                ->orWhere('orders.payment_type', 'like', '%' . $filter . '%')
                ->orWhere('orders.payment_status', 'like', '%' . $filter . '%')
                ->orWhere('orders.status', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $orders = Order::sortable()->paginate(10);
        }
        return view('admin.orders.index', compact('orders', 'filter'));
    }
}

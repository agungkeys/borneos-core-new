<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\{Merchant, Order, OrderDetail, Payment};
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $merchant = Merchant::where(['vendor_id' => auth()->guard('merchant')->user()->id])->get()[0];
        if (!empty($filter)) {
            $orders = Order::sortable()
                ->where([['orders.id', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant->id], ['status', '!=', 'new']])
                ->orWhere([['orders.customer_name', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant->id], ['status', '!=', 'new']])
                ->orWhere([['orders.total_item', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant->id], ['status', '!=', 'new']])
                ->orWhere([['orders.total_item_price', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant->id], ['status', '!=', 'new']])
                ->orWhere([['orders.payment_type', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant->id], ['status', '!=', 'new']])
                ->orWhere([['orders.payment_status', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant->id], ['status', '!=', 'new']])
                ->orWhere([['orders.status', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant->id], ['status', '!=', 'new']])
                ->paginate(10);
        } else {
            $orders = Order::sortable()->where([['merchant_id', $merchant->id], ['status', '!=', 'new']])->paginate(10);
        }
        return view('merchant.order.index', compact('orders', 'filter'));
    }
    public function detail(Order $order)
    {
        return view('merchant.order.detail', [
            'order'         => $order,
            'order_details' => OrderDetail::where('order_id', $order->id)->get()
        ]);
    }
}

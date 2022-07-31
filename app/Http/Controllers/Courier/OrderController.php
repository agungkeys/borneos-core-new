<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Http\Traits\Orders;
use App\Models\{Courier, Order, Payment, OrderDetail};
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    use Orders;
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $courier = Courier::where(['id' => auth()->guard('courier')->user()->id])->get()[0];
        if (!empty($filter)) {
            $orders = Order::sortable()
                ->where([['orders.id', 'like', '%' . $filter . '%'], ['id', '=', $courier->id], ['status', '!=', 'new']])
                ->orWhere([['orders.customer_name', 'like', '%' . $filter . '%'], ['id', '=', $courier->id], ['status', '!=', 'new']])
                ->orWhere([['orders.total_item', 'like', '%' . $filter . '%'], ['id', '=', $courier->id], ['status', '!=', 'new']])
                ->orWhere([['orders.total_item_price', 'like', '%' . $filter . '%'], ['id', '=', $courier->id], ['status', '!=', 'new']])
                ->orWhere([['orders.payment_type', 'like', '%' . $filter . '%'], ['id', '=', $courier->id], ['status', '!=', 'new']])
                ->orWhere([['orders.payment_status', 'like', '%' . $filter . '%'], ['id', '=', $courier->id], ['status', '!=', 'new']])
                ->orWhere([['orders.status', 'like', '%' . $filter . '%'], ['id', '=', $courier->id], ['status', '!=', 'new']])
                ->paginate(10);
        } else {
            $orders = Order::sortable()->where([['id', $courier->id], ['status', '!=', 'new']])->paginate(10);
        }
        return view('courier.orders.index', compact('orders', 'filter'));
    }

    public function detail(Order $order)
    {
        return view('courier.orders.detail', [
            'order'         => $order,
            'payments'      => Payment::where('status', 1)->get(),
            'order_details' => OrderDetail::where('order_id', $order->id)->get()
        ]);
    }

    public function updateDeliverStatus(Order $order)
    {
        $order->update(['status' => request('deliver_status')]);
        Alert::success('Data Diperbarui', 'success');
        return back();
    }
}

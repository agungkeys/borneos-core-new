<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Orders;
use App\Models\{Courier, Merchant, Order, OrderDetail};
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    use Orders;

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
        return view('admin.orders.index', compact('orders', 'filter', 'status'));
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

    public function add()
    {
        return view('admin.orders.add', [
            'couriers'  => Courier::all(),
            'merchants' => Merchant::all()
        ]);
    }

    public function detail(Order $order)
    {
        return view('admin.orders.detail', [
            'order'         => $order,
            'order_details' => OrderDetail::where('order_id', $order->id)->get()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'        => 'required',
            'customer_telp'        => 'required|numeric',
            'customer_address'     => 'required',
            'merchant'             => 'required',
            'order_type'           => 'required',
            'distance'             => 'required',
            'total_item'           => 'required|numeric',
            'latitude'             => 'required',
            'longitude'            => 'required',
            'total_distance_price' => 'required|numeric',
            'total_item_price'     => 'required|numeric',
            'total_price'          => 'required|numeric',
            'payment_total'        => 'required|numeric'
        ]);
        $order = new Order();
        $order->prefix = $this->GeneratePrefix();
        $order->order_type = $request->order_type;
        $order->merchant_id = $request->merchant;
        $order->courier_id = $request->courier == null ? null : $request->courier;
        $order->customer_name = $request->customer_name;
        $order->customer_telp = $request->customer_telp;
        $order->customer_address = $request->customer_address;
        $order->customer_address_lat = $request->latitude;
        $order->customer_address_lang = $request->longitude;
        $order->customer_notes = $request->customer_notes ?? '';
        $order->distance = $request->distance;
        $order->total_item = $request->total_item;
        $order->total_item_price = $request->total_item_price;
        $order->total_distance_price = $request->total_distance_price;
        $order->total_price = $request->total_price;
        $order->payment_type = $request->payment_type;
        $order->payment_total = $request->payment_total;
        $order->payment_bank_name = $request->payment_bank_name ?? '';
        $order->payment_account_number = $request->payment_account_number ?? '';
        $order->payment_status = $request->payment_status;
        $order->status = $request->payment_status == 'paid' ? 'processing' : 'new';
        $order->save();
        Alert::success('Created', 'Data Created Successfully');
        return redirect('/admin/orders');
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', [
            'order'         => $order,
            'couriers'      => Courier::all(),
            'order_details' => OrderDetail::where('order_id', $order->id)->get()
        ]);
    }
    public function update(Order $order)
    {
        if (!request('courier') || request('status') == 'cancel') {
            $order->update([
                'status'         => request('status') !== null ? request('status') : $order->status,
                'payment_status' => request('payment_status') !== null ? request('payment_status') : $order->payment_status,
                'status_notes'   => request('status_notes') ?? $order->status_notes
            ]);
        } else {
            $order->update([
                'status'         => request('status') !== null ? request('status') : $order->status,
                'payment_status' => request('payment_status') !== null ? request('payment_status') : $order->payment_status,
                'courier_id'     => request('courier'),
                'status_notes'   => request('status_notes') ?? $order->status_notes
            ]);
        }
        Alert::success('Updated', 'Data Order Updated');
        return redirect('/admin/orders');
    }
}

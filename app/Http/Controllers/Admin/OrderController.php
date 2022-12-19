<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderAdminRequest;
use App\Http\Traits\Orders;
use App\Models\{Courier, Merchant, Order, OrderDetail, Payment, Product};
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
                ->orWhereHas('merchant', function ($q) use ($filter) {
                    return $q->where('name', 'like', "%{$filter}%");
                })
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
                ->latest()->paginate(10);
        } else {
            if ($status == 'canceled') {
                $orders = Order::sortable()->where(['orders.status' => 'cancel'])->orWhere(['orders.status' => 'refund'])->latest()->paginate(10);
            } else {
                $orders = Order::sortable()->where('orders.status', 'like', '%' . $status . '%')->latest()->paginate(10);
            }
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
                ->orWhereHas('merchant', function ($q) use ($filter) {
                    return $q->where('name', 'like', "%{$filter}%");
                })
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
                ->latest()
                ->paginate(10);
        } else {
            $orders = Order::sortable()->latest()->paginate(10);
        }
        return view('admin.orders.index', compact('orders', 'filter'));
    }

    public function add()
    {
        return view('admin.orders.add', [
            'couriers'  => Courier::all(),
            'merchants' => Merchant::all(),
            'payments'  => Payment::where(['status' => 1])->get()
        ]);
    }

    public function detail(Order $order)
    {
        return view('admin.orders.detail', [
            'order'         => $order,
            'payments'      => Payment::where('status', 1)->get(),
            'order_details' => OrderDetail::where('order_id', $order->id)->get()
        ]);
    }
    public function store(OrderAdminRequest $request)
    {
        $order = Order::create([
            'prefix' => $this->GeneratePrefix(),
            'order_type' => $request->order_type,
            'merchant_id' => $request->merchant,
            'courier_id' => $request->courier == null ? null : $request->courier,
            'customer_name' => $request->customer_name,
            'customer_telp' => $request->customer_telp,
            'customer_address' => $request->customer_address,
            'customer_address_lat' => $request->latitude,
            'customer_address_lang' => $request->longitude,
            'customer_notes' => $request->customer_notes ?? '',
            'distance' => $request->distance,
            'total_item' => $request->total_item,
            'total_item_price' => $request->total_item_price,
            'total_distance_price' => $request->total_distance_price,
            'total_price' => $request->total_price,
            'payment_type' => $request->payment_type ?? '',
            'payment_total' => $request->payment_total,
            'payment_bank_name' => $request->payment_type == 'cash' ? '' : $request->payment_bank_name ?? '',
            'payment_account_number' => $request->payment_type == 'cash' ? '' : $request->payment_account_number ?? '',
            'payment_status' => $request->payment_status,
            'status' => $request->payment_status == 'paid' ? 'processing' : 'new',
        ]);
        (new \App\Notifications\OrderNotification())->toTelegram($order);
        Alert::success('Created', 'Data Created Successfully');
        return redirect('/admin/orders');
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', [
            'order'         => $order,
            'couriers'      => Courier::all(),
            'order_details' => OrderDetail::where('order_id', $order->id)->get(),
            'products'      => Product::where([['merchant_id','=',$order->merchant_id],['status','=',1]])->get()
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
        (new \App\Notifications\OrderNotification())->toTelegram($order);
        if($order->payment_status == 'paid'){
           (new \App\Notifications\NotifyUpdatePaymentStatusOrder())->toTelegram($order);
        }
        Alert::success('Updated', 'Data Order Updated');
        return redirect('/admin/orders');
    }
    public function updatePaymentFromPageDetail(Order $order)
    {
        if (request('update_payment_status') == 'unpaid') {
            $order->update(['payment_status' => request('update_payment_status')]);
        } else {
            if (request('payment_method') == null) {
                $order->update(['payment_status' => request('update_payment_status')]);
            } else {
                $order->update([
                    'payment_status' => request('update_payment_status'),
                    'payment_bank_name' => request('payment_bank_name'),
                    'payment_account_number' => request('payment_account_number')
                ]);
            }
        }
        if($order->payment_status == 'paid'){
           (new \App\Notifications\NotifyUpdatePaymentStatusOrder())->toTelegram($order);
        }
        Alert::success('Data Updated', 'success');
        return back();
    }

    public function FollowUpMerchant(Order $order)
    {
        return $this->FormatFollowUpMerchant($order);
    }
    public function FollowUpCustomerWhenDone(Order $order)
    {
        return $this->FormatFollowUpCustomerWhenDone($order);
    }
    public function updateProductOrderDetail(Request $request)
    {
        $request->validate([
            'price'       => 'required|numeric',
            'qty'         => 'required|numeric',
            'total_price' => 'required|numeric'
        ]);
        $orderDetail = OrderDetail::find($request->id_order_detail);
        $orderDetail->update([
            'product_price'       => $request->price,
            'product_qty'         => $request->qty,
            'product_total_price' => $request->total_price,
            'notes'               => $request->notes
        ]);
        $productQty = OrderDetail::where('order_id','=',$request->id_order)->get('product_qty')->sum('product_qty');
        $productTotalPrice = OrderDetail::where('order_id','=',$request->id_order)->get('product_total_price')->sum('product_total_price');
        $order = Order::find($request->id_order);
        $order->update([
            'total_item' => $productQty,
            'total_item_price' => $productTotalPrice,
            'total_price' => $productTotalPrice + $order->total_distance_price
        ]);
        Alert::toast('Updated', 'success');
        return redirect()->back();
    }
    public function deleteProductOrderDetail(OrderDetail $orderDetail)
    {
        $productQty = OrderDetail::where([['order_id','=',$orderDetail->order_id],['id','!=',$orderDetail->id]])->get('product_qty')->sum('product_qty') ?? 0;
        $productTotalPrice = OrderDetail::where([['order_id','=',$orderDetail->order_id],['id','!=',$orderDetail->id]])->get('product_total_price')->sum('product_total_price') ?? 0;
        $order = Order::find($orderDetail->order_id);
        $order->update([
            'total_item' => $productQty,
            'total_item_price' => $productTotalPrice,
            'total_price' => $productTotalPrice + $order->total_distance_price
        ]);
        $orderDetail->delete();
        return response()->json(['prefix' => $order->prefix,'status' => 200]);
    }
    public function updateDistanceOrderDetail(Request $request)
    {
        $request->validate([
            'distance' => 'required',
            'total_distance_price' => 'required|numeric'
        ]);
        $order = Order::find($request->id_order);
        $order->update([
            'distance' => $request->distance,
            'total_distance_price' => $request->total_distance_price,
            'total_price' => $order->total_item_price + $request->total_distance_price
        ]);
        Alert::toast('Updated', 'success');
        return redirect()->back();
    }
    public function addProductOrderDetail(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        OrderDetail::create([
            'order_id' => $request->order_id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_price' => substr($product->price,0,-3),
            'product_discount' => 0,
            'product_discount_type' => $product->discount_type ? $product->discount_type : '', 
            'product_image' => $product->image,
            'product_image_additional' => $product->additional_image,
            'product_qty' => 1,
            'product_total_price'=> substr($product->price,0,-3),
            'notes' => ''
        ]);
        $productQty = OrderDetail::where('order_id','=',$request->order_id)->get('product_qty')->sum('product_qty') ?? 0;
        $productTotalPrice = OrderDetail::where('order_id','=',$request->order_id)->get('product_total_price')->sum('product_total_price') ?? 0;
        $order = Order::find($request->order_id);
        $order->update([
            'total_item' => $productQty,
            'total_item_price' => $productTotalPrice,
            'total_price' => $productTotalPrice + $order->total_distance_price
        ]);
        Alert::success('Data Created', 'success');
        return back();
    }
}

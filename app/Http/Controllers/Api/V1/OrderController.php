<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Traits\FormatMeta;
use App\Http\Traits\Orders;
use App\Models\{Order, OrderDetail};
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use FormatMeta, Orders;

    public function __construct()
    {
        $this->middleware('tokenb');
    }

    public function get_order_detail(Request $request)
    {
        if (Order::where('prefix', '=', $request->prefix ?? '')->doesntExist()) {
            return response()->json(['status' => 'error', 'data' => null]);
        } else {
            $order = Order::where('prefix', '=', $request->prefix)->get()[0];
            return response()->json(['status' => 'success', 'data' => $this->resultOrderDetail($order)]);
        }
    }

    public function order_store(OrderRequest $request)
    {
        $order = Order::create([
            'prefix' => $this->GeneratePrefix(),
            'order_type' => $request->orderType,
            'merchant_id' => $request->merchantId,
            'customer_name' => $request->customerName,
            'customer_telp' => $request->customerTelp,
            'customer_address' => $request->customerAddress,
            'customer_address_lat' => $request->customerAddressLat,
            'customer_address_lang' => $request->customerAddressLng,
            'customer_notes' => $request->customerNotes ?? '',
            'distance' => $request->distance ?? '',
            'total_item' => $request->totalItem,
            'total_item_price' => $request->totalItemPrice,
            'total_distance_price' => $request->totalDistancePrice ?? 0,
            'total_price' => $request->totalPrice,
            'payment_type' => $request->paymentType ?? '',
            'payment_total' => $request->paymentTotal ?? 0,
            'payment_bank_name' => $request->paymentBankName ?? '',
            'payment_account_number' => $request->paymentAccountNumber ?? '',
            'payment_status' => $request->paymentStatus,
            'status' => $request->status ?? 'new',
            'status_notes' => $request->statusNotes ?? '',
            'coupon_code' => $request->couponCode ?? '',
        ]);
        if ($request->data) {
            foreach ($request->data as $data) {
                OrderDetail::create([
                    'order_id'                 => $order->id,
                    'product_id'               => $data['productId'],
                    'product_name'             => $data['productName'],
                    'product_price'            => $data['productPrice'],
                    'product_discount'         => $data['productDiscount'] == null ? 0 : $data['productDiscount'],
                    'product_discount_type'    => $data['productDiscountType'] == null ? '' : $data['productDiscountType'],
                    'product_image'            => $data['productImage'] ? $data['productImage'] : '',
                    'product_image_additional' => $data['productImageAdditional'] ? json_encode($data['productImageAdditional']) : '',
                    'product_qty'              => $data['productQty'],
                    'product_total_price'      => $data['productTotalPrice'],
                    'notes'                    => $data['notes'] == null ? '' : $data['notes']
                ]);
            }
        }
        (new \App\Notifications\OrderNotification())->toTelegram($order);
        $result = $this->MetaOrderStore($order);
        return response()->json($result);
    }
    public function update_order(Request $request)
    {
        if (Order::where('prefix', '=', $request->prefix ?? '')->doesntExist()) {
            return response()->json(['status' => 'error', 'data' => null]);
        } else {
            $order = Order::where('prefix', '=', $request->prefix)->get()[0];
            $order->update([
                'payment_id' => $request->paymentId ? $request->paymentId : $order->payment_id,
                'payment_type' => $request->paymentType ? $request->paymentType : $order->payment_type,
                'payment_bank_name' => $request->paymentBankName ? $request->paymentBankName : $order->payment_bank_name,
                'payment_account_number' => $request->paymentAccountNumber ? $request->paymentAccountNumber : $order->payment_account_number,
                'payment_status' => $request->paymentStatus ? $request->paymentStatus : $order->payment_status
            ]);
            if ($order->payment_status == 'paid') {
                (new \App\Notifications\NotifyUpdatePaymentStatusOrder())->toTelegram($order);
            }
            return response()->json(['status' => 'success', 'data' => $this->resultOrderDetail($order)]);
        }
    }
}

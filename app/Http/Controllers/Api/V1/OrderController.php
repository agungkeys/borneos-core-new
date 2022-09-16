<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Traits\FormatMeta;
use App\Models\{Order, OrderDetail};
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use FormatMeta;

    public function order_store(OrderRequest $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $prefix_generate = Str::random(20);
            $prefix = $prefix_generate;
            $orders = new Order;
            $orders->prefix = $prefix;
            $orders->order_type = $request->orderType;
            $orders->merchant_id = $request->merchantId;
            $orders->customer_name = $request->customerName;
            $orders->customer_telp = $request->customerTelp;
            $orders->customer_address = $request->customerAddress;
            $orders->customer_address_lat = $request->customerAddressLat;
            $orders->customer_address_lang = $request->customerAddressLng;
            $orders->customer_notes = $request->customerNotes ?? '';
            $orders->distance = $request->distance ?? '';
            $orders->total_item = $request->totalItem;
            $orders->total_item_price = $request->totalItemPrice;
            $orders->total_distance_price = $request->totalDistancePrice ?? 0;
            $orders->total_price = $request->totalPrice;
            $orders->payment_type = $request->paymentType;
            $orders->payment_total = $request->paymentTotal ?? 0;
            $orders->payment_bank_name = $request->paymentBankName ?? '';
            $orders->payment_account_number = $request->paymentAccountNumber ?? 0;
            $orders->payment_status = $request->paymentStatus;
            $orders->status = $request->status ?? 'new';
            $orders->status_notes = $request->statusNotes ?? '';
            $orders->save();
            $order_id = Order::get('id')->max('id') ?? 1;
            $orderId = $order_id;
            if ($request->data) {
                foreach ($request->data as $data) {
                    OrderDetail::create([
                        'order_id'                 => $orderId,
                        'product_id'               => $data['productId'],
                        'product_name'             => $data['productName'],
                        'product_price'            => $data['productPrice'],
                        'product_discount'         => $data['productDiscount'] == null ? 0 : $data['productDiscount'],
                        'product_discount_type'    => $data['productDiscountType'] == null ? '' : $data['productDiscountType'],
                        'product_image'            => $data['productImage'] ? $data['productImage'] : '',
                        'product_image_additional' => $data['productImageAdditional'] ? json_encode($data['productImageAdditional']): '',
                        'product_qty'              => $data['productQty'],
                        'product_total_price'      => $data['productTotalPrice'],
                        'notes'                    => $data['notes'] == null ? '' : $data['notes']
                    ]);
                }
            }
            $result = $this->MetaOrderStore(['request' => $request->all(), 'prefix' => $prefix, 'order_id' => $order_id]);
            return response()->json($result);
        } else {
            return response()->json(['status' => 'error', 'data' => null], 401);
        }
    }
}

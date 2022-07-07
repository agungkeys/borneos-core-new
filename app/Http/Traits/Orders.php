<?php

namespace App\Http\Traits;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;

trait Orders
{
    public function countPrefix($prefix)
    {
        return Order::where('prefix', $prefix)->count();
    }
    public function GeneratePrefix()
    {
        $generate = Str::random(20);
        $prefix = $generate;
        if ($this->countPrefix($prefix) > 0) {
            $prefix_2 = $generate;
            if ($this->countPrefix($prefix_2) > 0) {
                $prefix_3 = $generate;
                if ($this->countPrefix($prefix_3) > 0) {
                    $prefix_4 = $generate;
                    if ($this->countPrefix($prefix_4) == 0) {
                        return $prefix_4;
                    }
                } else {
                    return $prefix_3;
                }
            } else {
                return $prefix_2;
            }
        } else {
            return $prefix;
        }
    }

    public function ResultFollowUpMerchants($order)
    {
        //$bold = '%2A';
        $space = '%20';
        $enter = '%0A';
        $orderDetail = OrderDetail::where('order_id', $order->id)->get();
        if ($orderDetail->count() > 0) {
            if ($orderDetail->count() == 1) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes = $d1->notes ? $d1->notes : '-';
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes
                $enter$enter Total Harga Pesanan : Rp. $d1_product_total_price";
                return response()->json(['message' => $message, 'total' => 1]);
            } elseif ($orderDetail->count() == 2) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 2]);
            } elseif ($orderDetail->count() == 3) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 3]);
            } elseif ($orderDetail->count() == 4) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price + $d4->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 4]);
            } elseif ($orderDetail->count() == 5) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price + $d4->product_total_price + $d5->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 5]);
            } elseif ($orderDetail->count() == 6) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 6]);
            } elseif ($orderDetail->count() == 7) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price + $d7->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 7]);
            } elseif ($orderDetail->count() == 8) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price + $d7->product_total_price + $d8->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 8]);
            } elseif ($orderDetail->count() == 9) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $d9 = $orderDetail[8];
                $d9_product_price = number_format($d9->product_price, 0, ',', '.');
                $d9_product_total_price = number_format($d9->product_total_price, 0, ',', '.');
                $notes_9 = $d9->notes ? $d9->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price
                    + $d7->product_total_price + $d8->product_total_price + $d9->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter $enter %2A9. $d9->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d9_product_price
                $enter Quantity ( @ ) : $d9->product_qty 
                $enter Total Harga$space$space$space : Rp. $d9_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_9
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 9]);
            } elseif ($orderDetail->count() == 10) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $d9 = $orderDetail[8];
                $d9_product_price = number_format($d9->product_price, 0, ',', '.');
                $d9_product_total_price = number_format($d9->product_total_price, 0, ',', '.');
                $notes_9 = $d9->notes ? $d9->notes : '-';
                $d10 = $orderDetail[9];
                $d10_product_price = number_format($d10->product_price, 0, ',', '.');
                $d10_product_total_price = number_format($d10->product_total_price, 0, ',', '.');
                $notes_10 = $d10->notes ? $d10->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price
                    + $d7->product_total_price + $d8->product_total_price + $d9->product_total_price + $d10->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter $enter %2A9. $d9->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d9_product_price
                $enter Quantity ( @ ) : $d9->product_qty 
                $enter Total Harga$space$space$space : Rp. $d9_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_9
                $enter $enter %2A10. $d10->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d10_product_price
                $enter Quantity ( @ ) : $d10->product_qty 
                $enter Total Harga$space$space$space : Rp. $d10_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_10
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 10]);
            } elseif ($orderDetail->count() == 11) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $d9 = $orderDetail[8];
                $d9_product_price = number_format($d9->product_price, 0, ',', '.');
                $d9_product_total_price = number_format($d9->product_total_price, 0, ',', '.');
                $notes_9 = $d9->notes ? $d9->notes : '-';
                $d10 = $orderDetail[9];
                $d10_product_price = number_format($d10->product_price, 0, ',', '.');
                $d10_product_total_price = number_format($d10->product_total_price, 0, ',', '.');
                $notes_10 = $d10->notes ? $d10->notes : '-';
                $d11 = $orderDetail[10];
                $d11_product_price = number_format($d11->product_price, 0, ',', '.');
                $d11_product_total_price = number_format($d11->product_total_price, 0, ',', '.');
                $notes_11 = $d11->notes ? $d11->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price
                    + $d7->product_total_price + $d8->product_total_price + $d9->product_total_price + $d10->product_total_price + $d11->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter $enter %2A9. $d9->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d9_product_price
                $enter Quantity ( @ ) : $d9->product_qty 
                $enter Total Harga$space$space$space : Rp. $d9_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_9
                $enter $enter %2A10. $d10->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d10_product_price
                $enter Quantity ( @ ) : $d10->product_qty 
                $enter Total Harga$space$space$space : Rp. $d10_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_10
                $enter $enter %2A11. $d11->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d11_product_price
                $enter Quantity ( @ ) : $d11->product_qty 
                $enter Total Harga$space$space$space : Rp. $d11_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_11
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 11]);
            } elseif ($orderDetail->count() == 12) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $d9 = $orderDetail[8];
                $d9_product_price = number_format($d9->product_price, 0, ',', '.');
                $d9_product_total_price = number_format($d9->product_total_price, 0, ',', '.');
                $notes_9 = $d9->notes ? $d9->notes : '-';
                $d10 = $orderDetail[9];
                $d10_product_price = number_format($d10->product_price, 0, ',', '.');
                $d10_product_total_price = number_format($d10->product_total_price, 0, ',', '.');
                $notes_10 = $d10->notes ? $d10->notes : '-';
                $d11 = $orderDetail[10];
                $d11_product_price = number_format($d11->product_price, 0, ',', '.');
                $d11_product_total_price = number_format($d11->product_total_price, 0, ',', '.');
                $notes_11 = $d11->notes ? $d11->notes : '-';
                $d12 = $orderDetail[11];
                $d12_product_price = number_format($d12->product_price, 0, ',', '.');
                $d12_product_total_price = number_format($d12->product_total_price, 0, ',', '.');
                $notes_12 = $d12->notes ? $d12->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price
                    + $d7->product_total_price + $d8->product_total_price + $d9->product_total_price
                    + $d10->product_total_price + $d11->product_total_price + $d12->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter $enter %2A9. $d9->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d9_product_price
                $enter Quantity ( @ ) : $d9->product_qty 
                $enter Total Harga$space$space$space : Rp. $d9_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_9
                $enter $enter %2A10. $d10->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d10_product_price
                $enter Quantity ( @ ) : $d10->product_qty 
                $enter Total Harga$space$space$space : Rp. $d10_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_10
                $enter $enter %2A11. $d11->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d11_product_price
                $enter Quantity ( @ ) : $d11->product_qty 
                $enter Total Harga$space$space$space : Rp. $d11_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_11
                $enter $enter %2A12. $d12->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d12_product_price
                $enter Quantity ( @ ) : $d12->product_qty 
                $enter Total Harga$space$space$space : Rp. $d12_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_12
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 12]);
            } elseif ($orderDetail->count() == 13) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $d9 = $orderDetail[8];
                $d9_product_price = number_format($d9->product_price, 0, ',', '.');
                $d9_product_total_price = number_format($d9->product_total_price, 0, ',', '.');
                $notes_9 = $d9->notes ? $d9->notes : '-';
                $d10 = $orderDetail[9];
                $d10_product_price = number_format($d10->product_price, 0, ',', '.');
                $d10_product_total_price = number_format($d10->product_total_price, 0, ',', '.');
                $notes_10 = $d10->notes ? $d10->notes : '-';
                $d11 = $orderDetail[10];
                $d11_product_price = number_format($d11->product_price, 0, ',', '.');
                $d11_product_total_price = number_format($d11->product_total_price, 0, ',', '.');
                $notes_11 = $d11->notes ? $d11->notes : '-';
                $d12 = $orderDetail[11];
                $d12_product_price = number_format($d12->product_price, 0, ',', '.');
                $d12_product_total_price = number_format($d12->product_total_price, 0, ',', '.');
                $notes_12 = $d11->notes ? $d12->notes : '-';
                $d13 = $orderDetail[12];
                $d13_product_price = number_format($d13->product_price, 0, ',', '.');
                $d13_product_total_price = number_format($d13->product_total_price, 0, ',', '.');
                $notes_13 = $d13->notes ? $d13->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price
                    + $d7->product_total_price + $d8->product_total_price + $d9->product_total_price
                    + $d10->product_total_price + $d11->product_total_price + $d12->product_total_price + $d13->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter $enter %2A9. $d9->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d9_product_price
                $enter Quantity ( @ ) : $d9->product_qty 
                $enter Total Harga$space$space$space : Rp. $d9_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_9
                $enter $enter %2A10. $d10->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d10_product_price
                $enter Quantity ( @ ) : $d10->product_qty 
                $enter Total Harga$space$space$space : Rp. $d10_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_10
                $enter $enter %2A11. $d11->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d11_product_price
                $enter Quantity ( @ ) : $d11->product_qty 
                $enter Total Harga$space$space$space : Rp. $d11_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_11
                $enter $enter %2A12. $d12->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d12_product_price
                $enter Quantity ( @ ) : $d12->product_qty 
                $enter Total Harga$space$space$space : Rp. $d12_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_12
                $enter $enter %2A13. $d13->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d13_product_price
                $enter Quantity ( @ ) : $d13->product_qty 
                $enter Total Harga$space$space$space : Rp. $d13_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_13
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 13]);
            } elseif ($orderDetail->count() == 14) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $d9 = $orderDetail[8];
                $d9_product_price = number_format($d9->product_price, 0, ',', '.');
                $d9_product_total_price = number_format($d9->product_total_price, 0, ',', '.');
                $notes_9 = $d9->notes ? $d9->notes : '-';
                $d10 = $orderDetail[9];
                $d10_product_price = number_format($d10->product_price, 0, ',', '.');
                $d10_product_total_price = number_format($d10->product_total_price, 0, ',', '.');
                $notes_10 = $d10->notes ? $d10->notes : '-';
                $d11 = $orderDetail[10];
                $d11_product_price = number_format($d11->product_price, 0, ',', '.');
                $d11_product_total_price = number_format($d11->product_total_price, 0, ',', '.');
                $notes_11 = $d11->notes ? $d11->notes : '-';
                $d12 = $orderDetail[11];
                $d12_product_price = number_format($d12->product_price, 0, ',', '.');
                $d12_product_total_price = number_format($d12->product_total_price, 0, ',', '.');
                $notes_12 = $d11->notes ? $d12->notes : '-';
                $d13 = $orderDetail[12];
                $d13_product_price = number_format($d13->product_price, 0, ',', '.');
                $d13_product_total_price = number_format($d13->product_total_price, 0, ',', '.');
                $notes_13 = $d13->notes ? $d13->notes : '-';
                $d14 = $orderDetail[13];
                $d14_product_price = number_format($d14->product_price, 0, ',', '.');
                $d14_product_total_price = number_format($d14->product_total_price, 0, ',', '.');
                $notes_14 = $d14->notes ? $d14->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price
                    + $d7->product_total_price + $d8->product_total_price + $d9->product_total_price
                    + $d10->product_total_price + $d11->product_total_price + $d12->product_total_price
                    + $d13->product_total_price + $d14->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter $enter %2A9. $d9->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d9_product_price
                $enter Quantity ( @ ) : $d9->product_qty 
                $enter Total Harga$space$space$space : Rp. $d9_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_9
                $enter $enter %2A10. $d10->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d10_product_price
                $enter Quantity ( @ ) : $d10->product_qty 
                $enter Total Harga$space$space$space : Rp. $d10_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_10
                $enter $enter %2A11. $d11->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d11_product_price
                $enter Quantity ( @ ) : $d11->product_qty 
                $enter Total Harga$space$space$space : Rp. $d11_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_11
                $enter $enter %2A12. $d12->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d12_product_price
                $enter Quantity ( @ ) : $d12->product_qty 
                $enter Total Harga$space$space$space : Rp. $d12_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_12
                $enter $enter %2A13. $d13->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d13_product_price
                $enter Quantity ( @ ) : $d13->product_qty 
                $enter Total Harga$space$space$space : Rp. $d13_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_13
                $enter $enter %2A14. $d14->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d14_product_price
                $enter Quantity ( @ ) : $d14->product_qty 
                $enter Total Harga$space$space$space : Rp. $d14_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_14
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 14]);
            } elseif ($orderDetail->count() == 15) {
                $d1 = $orderDetail[0];
                $d1_product_price = number_format($d1->product_price, 0, ',', '.');
                $d1_product_total_price = number_format($d1->product_total_price, 0, ',', '.');
                $notes_1 = $d1->notes ? $d1->notes : '-';
                $d2 = $orderDetail[1];
                $d2_product_price = number_format($d2->product_price, 0, ',', '.');
                $d2_product_total_price = number_format($d2->product_total_price, 0, ',', '.');
                $notes_2 = $d2->notes ? $d2->notes : '-';
                $d3 = $orderDetail[2];
                $d3_product_price = number_format($d3->product_price, 0, ',', '.');
                $d3_product_total_price = number_format($d3->product_total_price, 0, ',', '.');
                $notes_3 = $d3->notes ? $d3->notes : '-';
                $d4 = $orderDetail[3];
                $d4_product_price = number_format($d4->product_price, 0, ',', '.');
                $d4_product_total_price = number_format($d4->product_total_price, 0, ',', '.');
                $notes_4 = $d4->notes ? $d4->notes : '-';
                $d5 = $orderDetail[4];
                $d5_product_price = number_format($d5->product_price, 0, ',', '.');
                $d5_product_total_price = number_format($d5->product_total_price, 0, ',', '.');
                $notes_5 = $d5->notes ? $d5->notes : '-';
                $d6 = $orderDetail[5];
                $d6_product_price = number_format($d6->product_price, 0, ',', '.');
                $d6_product_total_price = number_format($d6->product_total_price, 0, ',', '.');
                $notes_6 = $d6->notes ? $d6->notes : '-';
                $d7 = $orderDetail[6];
                $d7_product_price = number_format($d7->product_price, 0, ',', '.');
                $d7_product_total_price = number_format($d7->product_total_price, 0, ',', '.');
                $notes_7 = $d7->notes ? $d7->notes : '-';
                $d8 = $orderDetail[7];
                $d8_product_price = number_format($d8->product_price, 0, ',', '.');
                $d8_product_total_price = number_format($d8->product_total_price, 0, ',', '.');
                $notes_8 = $d8->notes ? $d8->notes : '-';
                $d9 = $orderDetail[8];
                $d9_product_price = number_format($d9->product_price, 0, ',', '.');
                $d9_product_total_price = number_format($d9->product_total_price, 0, ',', '.');
                $notes_9 = $d9->notes ? $d9->notes : '-';
                $d10 = $orderDetail[9];
                $d10_product_price = number_format($d10->product_price, 0, ',', '.');
                $d10_product_total_price = number_format($d10->product_total_price, 0, ',', '.');
                $notes_10 = $d10->notes ? $d10->notes : '-';
                $d11 = $orderDetail[10];
                $d11_product_price = number_format($d11->product_price, 0, ',', '.');
                $d11_product_total_price = number_format($d11->product_total_price, 0, ',', '.');
                $notes_11 = $d11->notes ? $d11->notes : '-';
                $d12 = $orderDetail[11];
                $d12_product_price = number_format($d12->product_price, 0, ',', '.');
                $d12_product_total_price = number_format($d12->product_total_price, 0, ',', '.');
                $notes_12 = $d11->notes ? $d12->notes : '-';
                $d13 = $orderDetail[12];
                $d13_product_price = number_format($d13->product_price, 0, ',', '.');
                $d13_product_total_price = number_format($d13->product_total_price, 0, ',', '.');
                $notes_13 = $d13->notes ? $d13->notes : '-';
                $d14 = $orderDetail[13];
                $d14_product_price = number_format($d14->product_price, 0, ',', '.');
                $d14_product_total_price = number_format($d14->product_total_price, 0, ',', '.');
                $notes_14 = $d14->notes ? $d14->notes : '-';
                $d15 = $orderDetail[14];
                $d15_product_price = number_format($d15->product_price, 0, ',', '.');
                $d15_product_total_price = number_format($d15->product_total_price, 0, ',', '.');
                $notes_15 = $d15->notes ? $d15->notes : '-';
                $grand_total = number_format($d1->product_total_price + $d2->product_total_price + $d3->product_total_price
                    + $d4->product_total_price + $d5->product_total_price + $d6->product_total_price
                    + $d7->product_total_price + $d8->product_total_price + $d9->product_total_price
                    + $d10->product_total_price + $d11->product_total_price + $d12->product_total_price
                    + $d13->product_total_price + $d14->product_total_price + $d15->product_total_price, 0, ',', '.');
                $message = "Halo Kak kami dari Borneos ingin memesan orderan : 
                $enter $enter %2A1. $d1->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d1_product_price
                $enter Quantity ( @ ) : $d1->product_qty 
                $enter Total Harga$space$space$space : Rp. $d1_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_1
                $enter $enter %2A2. $d2->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d2_product_price
                $enter Quantity ( @ ) : $d2->product_qty 
                $enter Total Harga$space$space$space : Rp. $d2_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_2
                $enter $enter %2A3. $d3->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d3_product_price
                $enter Quantity ( @ ) : $d3->product_qty 
                $enter Total Harga$space$space$space : Rp. $d3_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_3
                $enter $enter %2A4. $d4->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d4_product_price
                $enter Quantity ( @ ) : $d4->product_qty 
                $enter Total Harga$space$space$space : Rp. $d4_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_4
                $enter $enter %2A5. $d5->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d5_product_price
                $enter Quantity ( @ ) : $d5->product_qty 
                $enter Total Harga$space$space$space : Rp. $d5_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_5
                $enter $enter %2A6. $d6->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d6_product_price
                $enter Quantity ( @ ) : $d6->product_qty 
                $enter Total Harga$space$space$space : Rp. $d6_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_6
                $enter $enter %2A7. $d7->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d7_product_price
                $enter Quantity ( @ ) : $d7->product_qty 
                $enter Total Harga$space$space$space : Rp. $d7_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_7
                $enter $enter %2A8. $d8->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d8_product_price
                $enter Quantity ( @ ) : $d8->product_qty 
                $enter Total Harga$space$space$space : Rp. $d8_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_8
                $enter $enter %2A9. $d9->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d9_product_price
                $enter Quantity ( @ ) : $d9->product_qty 
                $enter Total Harga$space$space$space : Rp. $d9_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_9
                $enter $enter %2A10. $d10->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d10_product_price
                $enter Quantity ( @ ) : $d10->product_qty 
                $enter Total Harga$space$space$space : Rp. $d10_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_10
                $enter $enter %2A11. $d11->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d11_product_price
                $enter Quantity ( @ ) : $d11->product_qty 
                $enter Total Harga$space$space$space : Rp. $d11_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_11
                $enter $enter %2A12. $d12->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d12_product_price
                $enter Quantity ( @ ) : $d12->product_qty 
                $enter Total Harga$space$space$space : Rp. $d12_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_12
                $enter $enter %2A13. $d13->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d13_product_price
                $enter Quantity ( @ ) : $d13->product_qty 
                $enter Total Harga$space$space$space : Rp. $d13_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_13
                $enter $enter %2A14. $d14->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d14_product_price
                $enter Quantity ( @ ) : $d14->product_qty 
                $enter Total Harga$space$space$space : Rp. $d14_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_14
                $enter $enter %2A15. $d15->product_name%2A 
                $enter Harga $space$space$space$space$space$space$space$space$space$space$space$space : Rp. $d15_product_price
                $enter Quantity ( @ ) : $d15->product_qty 
                $enter Total Harga$space$space$space : Rp. $d15_product_total_price
                $enter Notes$space$space$space$space$space$space$space$space$space$space$space$space$space : $notes_15
                $enter$enter Total Harga Pesanan : Rp. $grand_total";
                return response()->json(['message' => $message, 'total' => 15]);
            }
        } elseif ($orderDetail->count() == 0) {
            $merchant = $order->merchant_id ? $order->merchant->name : '-';
            $message = "Halo Kak kami dari Borneos ingin memesan di $merchant";
            return response()->json(['message' => $message, 'total' => 0]);
        }
    }
}

<?php

namespace App\Http\Traits;

trait Notify
{
    public function textNotificationOrderNewTelegram($data)
    {
        $order = $data;
        $orderStatus = strtoupper("order status : ".$order->status ." (id-$order->id)");
        $urlEditOrder = "https://app.borneos.co/admin/orders/edit/$order->prefix";
        $textIntro = "\n\n<b>$orderStatus</b>\n\nHalo min ada orderan <b>BARU</b> dari $order->customer_name\n$urlEditOrder";
        return $textIntro;

    }
    public function textNotificationOrderProcessingTelegram($data)
    {
        $order = $data;
        $merchantName = $order->merchant_id && $order->merchant ? $order->merchant->name : '';
        $merchantAddress = $order->merchant_id && $order->merchant ? $order->merchant->address : '';
        $merchantTelp = $order->merchant_id && $order->merchant ? $this->replacePhoneFormatWA($order->merchant->phone) : '';
        $customerName = $order->customer_name ?? '';
        $line = "\n\n- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
        $orderStatus = strtoupper("order status : ".$order->status ." (id-$order->id)");
        $textIntro = "\n\n<b>$orderStatus</b>\n\nHalo Kak, saya $customerName\ningin konfirmasi pesanan dari :\n\n$merchantName,\n$merchantAddress,\nTelp : $merchantTelp $line";
        $detail = $this->totalDistancePriceWithCustomerAddress($order);

        if($order->orders->count() == 1){
            $cart_1 = $this->listCart($order->orders[0]);
            return "".$textIntro .$cart_1 .$detail;
        } elseif($order->orders->count() == 2){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);   
            return "".$textIntro .$cart_1 ."\n".$cart_2 .$detail;
        }elseif($order->orders->count() == 3){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 .$detail;
        }elseif($order->orders->count() == 4){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4 .$detail;
        }elseif($order->orders->count() == 5){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5.$detail;
        }elseif($order->orders->count() == 6){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6.$detail;
        }elseif($order->orders->count() == 7){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7.$detail;
        }elseif($order->orders->count() == 8){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8.$detail;
        }elseif($order->orders->count() == 9){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9.$detail;
        }elseif($order->orders->count() == 10){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10.$detail;
        }elseif($order->orders->count() == 11){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11.$detail;
        }elseif($order->orders->count() == 12){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12.$detail;
        }elseif($order->orders->count() == 13){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13.$detail;
        }elseif($order->orders->count() == 14){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            $cart_14 = $this->listCart($order->orders[13]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13."\n".$cart_14.$detail;
        }elseif($order->orders->count() == 15){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            $cart_14 = $this->listCart($order->orders[13]);
            $cart_15 = $this->listCart($order->orders[14]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13."\n".$cart_14."\n".$cart_15.$detail;
        }elseif($order->orders->count() == 16){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            $cart_14 = $this->listCart($order->orders[13]);
            $cart_15 = $this->listCart($order->orders[14]);
            $cart_16 = $this->listCart($order->orders[15]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13."\n".$cart_14."\n".$cart_15."\n".$cart_16.$detail;
        }elseif($order->orders->count() == 17){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            $cart_14 = $this->listCart($order->orders[13]);
            $cart_15 = $this->listCart($order->orders[14]);
            $cart_16 = $this->listCart($order->orders[15]);
            $cart_17 = $this->listCart($order->orders[16]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13."\n".$cart_14."\n".$cart_15."\n".$cart_16."\n".$cart_17.$detail;
        }elseif($order->orders->count() == 18){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            $cart_14 = $this->listCart($order->orders[13]);
            $cart_15 = $this->listCart($order->orders[14]);
            $cart_16 = $this->listCart($order->orders[15]);
            $cart_17 = $this->listCart($order->orders[16]);
            $cart_18 = $this->listCart($order->orders[17]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13."\n".$cart_14."\n".$cart_15."\n".$cart_16."\n".$cart_17."\n".$cart_18.$detail;
        }elseif($order->orders->count() == 19){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            $cart_14 = $this->listCart($order->orders[13]);
            $cart_15 = $this->listCart($order->orders[14]);
            $cart_16 = $this->listCart($order->orders[15]);
            $cart_17 = $this->listCart($order->orders[16]);
            $cart_18 = $this->listCart($order->orders[17]);
            $cart_19 = $this->listCart($order->orders[18]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13."\n".$cart_14."\n".$cart_15."\n".$cart_16."\n".$cart_17."\n".$cart_18."\n".$cart_19.$detail;
        }elseif($order->orders->count() == 20){
            $cart_1 = $this->listCart($order->orders[0]);
            $cart_2 = $this->listCart($order->orders[1]);
            $cart_3 = $this->listCart($order->orders[2]);
            $cart_4 = $this->listCart($order->orders[3]);
            $cart_5 = $this->listCart($order->orders[4]);
            $cart_6 = $this->listCart($order->orders[5]);
            $cart_7 = $this->listCart($order->orders[6]);
            $cart_8 = $this->listCart($order->orders[7]);
            $cart_9 = $this->listCart($order->orders[8]);
            $cart_10 = $this->listCart($order->orders[9]);
            $cart_11 = $this->listCart($order->orders[10]);
            $cart_12 = $this->listCart($order->orders[11]);
            $cart_13 = $this->listCart($order->orders[12]);
            $cart_14 = $this->listCart($order->orders[13]);
            $cart_15 = $this->listCart($order->orders[14]);
            $cart_16 = $this->listCart($order->orders[15]);
            $cart_17 = $this->listCart($order->orders[16]);
            $cart_18 = $this->listCart($order->orders[17]);
            $cart_19 = $this->listCart($order->orders[18]);
            $cart_20 = $this->listCart($order->orders[19]);
            return "".$textIntro .$cart_1 ."\n".$cart_2 ."\n".$cart_3 ."\n".$cart_4."\n".$cart_5."\n".$cart_6."\n".$cart_7."\n".$cart_8."\n".$cart_9."\n".$cart_10."\n".$cart_11."\n".$cart_12."\n".$cart_13."\n".$cart_14."\n".$cart_15."\n".$cart_16."\n".$cart_17."\n".$cart_18."\n".$cart_19."\n".$cart_20.$detail;
        }
    }
    public function replacePhoneFormatWA($phone){
        $firstTwoDigits = substr($phone,0,2);
        if($firstTwoDigits == '08'){
            $number = "+628" .substr($phone,2,strlen($phone));
            $link_wa = "https://wa.me/" .$number;
            return str_replace(' ', '', $link_wa);
        }else if($firstTwoDigits == '62'){
            $number = "+".$phone;
            $link_wa = "https://wa.me/" .$number;
            return str_replace(' ', '', $link_wa);
        }else if($firstTwoDigits == '+6'){
            $link_wa = "https://wa.me/" .$phone;
            return str_replace(' ', '', $link_wa);
        }
    }
    protected function listCart($order)
    {
        $productName = "Produk : $order->product_name \n";
        $productPrice = "Harga Produk  : Rp $order->product_price\n";
        $quantityProduct = "Qty : $order->product_qty\n";
        $productTotalPrice = "Total Harga : Rp $order->product_total_price\n";
        $notes = $order->notes ?? '';
        $productNotes = "Catatan : $notes\n";
        return "".$productName .$productPrice .$quantityProduct .$productTotalPrice .$productNotes;
    }
    protected function totalDistancePriceWithCustomerAddress($order)
    {
        $totalDistancePrice = "\nOngkir Pesanan : Rp $order->total_distance_price\n";
        $totalPrice = "Total Harga Pesanan : Rp $order->total_price";
        $customerName = "Nama : \n$order->customer_name\n\n";
        $customerAddress = "Alamat : \n$order->customer_address\n\n";
        $detailCustomerAddress = "Detail Alamat : \n$order->customer_notes\n\n";
        $line = "\n\n- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
        return "".$totalDistancePrice .$totalPrice .$line .$customerName .$customerAddress .$detailCustomerAddress;
    }
}
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
        $line = "\n\n- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
        $merchantName = $order->merchant_id && $order->merchant ? $order->merchant->name : '';
        $merchantAddress = $order->merchant_id && $order->merchant ? $order->merchant->address : '';
        $merchantTelp = $order->merchant_id && $order->merchant && $order->merchant->phone ? $this->replacePhoneFormatWA($order->merchant->phone) : '';
        $customerName = $order->customer_name ?? '';
        $customerNotes = $order->customer_notes ?? '-';
        $orderStatus = strtoupper("order status : ".$order->status ." (id-$order->id)");
        $textIntro = "\n\n<b>$orderStatus</b>\n\nHalo Kak, saya $customerName\ningin konfirmasi pesanan dari :\n\n$merchantName,\n$merchantAddress,\nTelp : $merchantTelp $line";
        
        $cartList = '';
        foreach($order->orders as $item){
            $cartList .= "Produk : $item->product_name \nHarga Produk : Rp $item->product_price\nQty : $item->product_qty\nTotal Harga : Rp $item->product_total_price\nCatatan : ".$item->notes ."\n\n" ?? "\n\n";
        }
        $joinAndFilterCartList = substr($cartList,0,strlen($cartList)-1);
        $totalPriceTotalDistancePrice = "\nOngkir Pesanan : Rp $order->total_distance_price\nTotal Harga Pesanan : Rp $order->total_price".$line;
        $detailCustomer = "Nama : \n$order->customer_name\n\nAlamat : \n$order->customer_address\n\nDetail Alamat : \n$customerNotes\n\n";
        return "".$textIntro .$joinAndFilterCartList .$totalPriceTotalDistancePrice .$detailCustomer;
    }

    public function textNotificationOrderOnTheWaytoTelegram($data)
    {
        $order = $data;
        $line = "\n\n- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n\n";
        $merchantName = $order->merchant_id && $order->merchant ? $order->merchant->name : '';
        $merchantAddress = $order->merchant_id && $order->merchant ? $order->merchant->address : '';
        $merchantTelp = $order->merchant_id && $order->merchant ? $this->replacePhoneFormatWA($order->merchant->phone) : '';
        $customerName = $order->customer_name ?? '';
        $customerNotes = $order->customer_notes ?? '-';
        $orderStatus = strtoupper("order status : ".$order->status ." (id-$order->id)");
        $urlEditOrder = "https://app.borneos.co/admin/orders/edit/".$order->prefix;
        $textIntro = "\n\n<b>$orderStatus</b>\n$urlEditOrder\n\nHalo Kak, saya $customerName\ningin konfirmasi pesanan dari :\n\n$merchantName,\n$merchantAddress,\nTelp : $merchantTelp $line";

        $cartList = '';
        foreach($order->orders as $item){
            $cartList .= "Produk : $item->product_name \nHarga Produk : Rp $item->product_price\nQty : $item->product_qty\nTotal Harga : Rp $item->product_total_price\nCatatan : ".$item->notes ."\n\n" ?? "\n\n";
        }
        $joinAndFilterCartList = substr($cartList,0,strlen($cartList)-1);

        $totalPriceTotalDistancePrice = "\nOngkir Pesanan : Rp $order->total_distance_price\nTotal Harga Pesanan : Rp $order->total_price".$line;
        $detailCustomer = "Nama : \n$order->customer_name\n\nAlamat : \n$order->customer_address\n\nDetail Alamat : \n$customerNotes\n\n";

        $courierName = $order->courier_id && $order->courier && $order->courier->name ? "".$order->courier->name : "-";
        $courierPhone = $order->courier_id && $order->courier && $order->courier->phone ? $this->replacePhoneFormatWA($order->courier->phone) : "-";
        $detailCourier = "Kurir : \n$courierName\n$courierPhone";

        return "".$textIntro .$joinAndFilterCartList .$totalPriceTotalDistancePrice .$detailCustomer .$detailCourier;
    }

    public function textNotifyOrderDeliveredToTelegram($data)
    {
        $order = $data;
        $orderStatus = strtoupper("order status : $order->status");
        $textIntro = "\n\n<b>$orderStatus</b>\n\nHalo Kak, orderan TELAH DIKIRIM\n\n";

        $customerName = $order->customer_name ? ucfirst($order->customer_name) : '-';
        $customerTelp = $order->customer_telp ? $this->replacePhoneFormatWA($order->customer_telp) : '-';
        $detailCustomer = "Pelanggan :\n$customerName\n$customerTelp\n\n";

        $courierName = $order->courier_id && $order->courier && $order->courier->name ? "".$order->courier->name : "-";
        $courierPhone = $order->courier_id && $order->courier && $order->courier->phone ? $this->replacePhoneFormatWA($order->courier->phone) : "-";
        $detailCourier = "Kurir : \n$courierName\n$courierPhone\n\n";

        $urlInvoiceOrder = "https://borneos.co/invoice/".$order->prefix;
        $textFooter = "Terimakasih telah berbelanja melalui borneos.co,\nanda dapat mengunduh invoice melalui :\n$urlInvoiceOrder";
        return "".$textIntro .$detailCustomer .$detailCourier .$textFooter;
    }
    public function textNotifyOrderCanceledToTelegram($data)
    {
        $order = $data;
        $orderStatus = strtoupper("order status : canceled");
        $textIntro = "\n\n<b>$orderStatus</b>\n\nHalo Kak, orderan TELAH DIBATALKAN\n\n";

        $customerName = $order->customer_name ? ucfirst($order->customer_name) : '-';
        $customerTelp = $order->customer_telp ? $this->replacePhoneFormatWA($order->customer_telp) : '-';
        $detailCustomer = "Pelanggan :\n$customerName\n$customerTelp\n\n";

        $textFooter = "Terimakasih telah mengunjungi borneos.co";
        return "".$textIntro .$detailCustomer .$textFooter;
    }
    
    public function replacePhoneFormatWA($phone)
    {
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
}
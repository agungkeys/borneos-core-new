@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-news-paper icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Order Detail<div class="page-title-subheading">Orders Detail {{ $order->prefix }}</div></div>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body" style="display: grid;">
        <div style="overflow-x:auto;">
             <div class="p-3 mb-3">          
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-5 mb-2">
                        <p class="lead"><b>Merchant</b></p>
                        <div class="table-responsive">
                            <table style="font-size: 12px">
                                <tr>
                                    <td>Name : {{ $order->merchant_id && $order->merchant->name ? $order->merchant->name : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Phone : {{ $order->merchant_id && $order->merchant->phone ? $order->merchant->phone : '-' }}</th>
                                </tr>
                                <tr>
                                    <td>Address : {{ $order->merchant_id && $order->merchant->address ? $order->merchant->address : '' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-5 mb-2">
                        @if($order->status == 'new')
                        <p class="badge badge-pill badge-info" style="float:right; font-size:10px;">Status&nbsp;:&nbsp;{{ $order->status }}</p>
                        @elseif($order->status == 'canceled')
                        <p class="badge badge-pill badge-danger" style="float:right; font-size:10px;">Status&nbsp;:&nbsp;{{ $order->status }}</p>
                        @else
                        <p class="badge badge-pill badge-success" style="float:right; font-size:10px;">Status&nbsp;:&nbsp;{{ $order->status }}</p>
                        @endif
                        <p class="lead"><b>Customer</b></p>
                        <div class="table-responsive">
                            <table style="font-size: 12px;">
                                <tr>
                                    <td style="width:20%">Name<span style="margin-left:14px">:</span></td>
                                    <th>{{ $order->customer_name }} Adndriawan Saputra</th>
                                </tr>
                                <tr>
                                    <td>Phone<span style="margin-left:12px">:</span></td>
                                    <td>{{ $order->customer_telp }}</td>
                                </tr>
                                <tr>
                                    <td>Address&nbsp;:</td>
                                    <td style="font-size: 11px">{{ $order->customer_address }}</td>
                                </tr>   
                                @if(strlen($order->customer_notes)>1)
                                <tr>
                                    <td>Notes<span style="margin-left:15px">:</span></td>
                                    <td style="font-size:11px">{{ $order->customer_notes }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>                           
            </div>
        </div>
      </div>
   </div>
    <div class="main-card mb-3 card">
      <div class="card-body">
        <div style="overflow-x:auto;">
            <div class="invoice p-3 mb-5">
                <div class="row">
                    <div class="col-12">
                        <h4>
                        <i class="fas fa-cart-arrow-down"></i> {{ $order->customer_name }}
                        <small class="float-right">Date: {{ date('d/m/Y', strtotime($order->created_at)); }}</small>
                        </h4>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 table-responsive">
                        <table style="font-size: 12px" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Discount</th>
                                <th>Product Discount Type</th>
                                <th>Product QTY</th>
                                <th>Product Total Price</th>
                                <th>Notes</th>      
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order_details as $order_detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order_detail->product_name }}</td>
                                    <td>{{ number_format($order_detail->product_price,0,',','.') }}</td>
                                    <td>{{ $order_detail->product_discount }}</td>
                                    <td>{{ $order_detail->product_discount_type }}</td>
                                    <td>{{ $order_detail->product_qty }}</td>
                                    <td>{{ number_format($order_detail->product_total_price,0,',','.') }}</td>
                                    <td>{{ $order_detail->notes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No order to display</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="lead">Distance</p>
                        <div class="table-responsive">
                            <table class="table" style="font-size: 12px">
                                <tr>
                                    <th style="width:50%">Distance:</th>
                                    <td>{{ $order->distance }}</td>
                                </tr>
                                <tr>
                                    <th>Total Distance Price:</th>
                                    <td>{{ number_format($order->total_distance_price,0,',','.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="lead">Payment Methods</p>
                        <div class="table-responsive">
                            <table class="table" style="font-size: 12px"> 
                                <tr>
                                    <th>Payment Type:</th>
                                    <td>{{ ucfirst($order->payment_type) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Status:</th>
                                    <td>{{ ucfirst($order->payment_status) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Bank Name:</th>
                                    <td>{{ $order->payment_bank_name }}</td>
                                </tr>
                                <tr>
                                <th>Payment Account Number:</th>
                                <td>{{ $order->payment_account_number }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Total:</th>
                                    <td>{{ number_format($order->payment_total,0,',','.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="lead">Amount</p>
                        <div class="table-responsive">
                            <table class="table" style="font-size: 12px">
                                <tr>
                                    <th style="width:50%">Total Item:</th>
                                    <td>{{ $order->total_item }}</td>
                                </tr>
                                <tr>
                                    <th>Total Item Price:</th>
                                    <td>{{ number_format($order->total_item_price,0,',','.') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Price:</th>
                                    <td>{{ number_format($order->total_price,0,',','.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"><hr>
                        <table style="font-size: 12px">
                            <tr>
                                <td>Courier&nbsp;:&nbsp;<b>{{ ucfirst($order->order_type )}}</b></td><br>
                            </tr>
                            <tr>
                                <td>{{ $order->courier_id ? $order->courier->name : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
   @include('sweetalert::alert')
 </div>
@endsection

@extends('layouts.app-merchant')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-news-paper icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Order Detail<div class="page-title-subheading">Invoice No. INV/{{ $order->id }}/{{date('d/m/Y', strtotime($order->created_at));}}/{{ $order->prefix }}</div></div>
         </div>
      </div>
   </div>
   <div class="row">
     <div class="col-12 col-lg-6 col-md-6 col-sm-12">
       <a href="/merchant/orders/all" class="text-secondary mb-3" style="display: flex; align-items: center; text-decoration: none;"><i class="pe-7s-angle-left" style="font-size: 2rem;"></i>Back to Order List</a>
     </div>
     <div class="col-12 col-lg-6 col-md-6 col-sm-12">
       <div class="d-block text-right">
         @if($order->order_type == 'borneos')
         <span class="badge badge-warning p-2">{{ $order->order_type }}</span>
         @elseif($order->order_type == 'bonjek')
         <span style="background-color: palevioletred" class="badge badge-info p-2">{{ $order->order_type }}</span>
         @elseif($order->order_type == 'legenda')
         <span class="badge badge-danger p-2">{{ $order->order_type }}</span>
         @else
         <span class="badge badge-secondary p-2">{{ $order->order_type }}</span>
         @endif

         @if($order->status == 'new')
         <p class="badge badge-info p-2">Order {{ $order->status }}</p>
         @elseif($order->status == 'canceled')
         <p class="badge badge-danger p-2">{{ $order->status }}</p>
         @else
         <p class="badge badge-success p-2">{{ $order->status }}</p>
         @endif

         @if($order->payment_status == 'paid')
         <p class="badge badge-success p-2">{{ ucfirst($order->payment_status) }}</p>
         @else
         <p style="background-color: red" class="badge badge-secondary p-2">{{ ucfirst($order->payment_status) }}</p>
         @endif
       </div>
     </div>
   </div>

   <div class="main-card mb-3 card" style="border-radius: 1.5em;">
      <div class="card-body p-4">
          <div class="row d-flex justify-content-between">
              <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                  <h3 class="card-title">Merchant Info</h3>
                  <table class="table table-borderless table-responsive">
                      <tr>
                          <td>Nama</td>
                          <th>{{ $order->merchant_id && $order->merchant->name ? $order->merchant->name : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Telp</td>
                          <th>{{ $order->merchant_id && $order->merchant->phone ? $order->merchant->phone : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Alamat</td>
                          <td>{{ $order->merchant_id && $order->merchant->address ? $order->merchant->address : '-' }}</td>
                      </tr>
                  </table>
              </div>
              <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                  <h3 class="card-title">Customer</h3>
                  <table class="table table-borderless table-responsive">
                      <tr>
                          <td>Nama</td>
                          <th>{{ $order->customer_name }}</th>
                      </tr>
                  </table>
              </div>
          </div>
      </div>
   </div>
   <div class="main-card mb-3 card" style="border-radius: 1.5em;">
      <div class="card-body p-4">
          <div class="invoice">
              <div class="row">
                  <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <h3 class="card-title">Products Info</h3>
                  </div>
                  <div class="col-12 col-lg-6 col-md-6 col-sm-12">

                  </div>
              </div>
              <div class="row mt-2">
                  <div class="col-12 table-responsive">
                      <table class="table table-hover table-striped">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Nama</th>
                              <th>Harga</th>
                              <th>Diskon</th>
                              <th>Diskon Tipe</th>
                              <th>Qty</th>
                              <th>Total Harga</th>
                              <th>Catatan</th>
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
          </div>
      </div>
   </div>

   <div class="main-card mb-3 card" style="border-radius: 1.5em;">
      <div class="card-body p-4">
          <div class="row">
              <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                  <h3 class="card-title">Courier Info</h3>
                  <table class="table table-borderless table-responsive">
                      <tr>
                          <td>Nama</td>
                          <th>{{ $order->courier_id ? $order->courier->name : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Telp</td>
                          <th>{{ $order->courier_id ? $order->courier->phone : '-' }}</th>
                      </tr>
                  </table>
              </div>
          </div>
      </div>
    </div>
   @include('sweetalert::alert')
 </div>
@endsection
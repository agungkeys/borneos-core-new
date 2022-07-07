@extends('layouts.app-admin')

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
       <a href="/admin/orders{{$order->status ? '/'.$order->status : ''}}" class="text-secondary mb-3" style="display: flex; align-items: center; text-decoration: none;"><i class="pe-7s-angle-left" style="font-size: 2rem;"></i>Back to Order List</a>
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
                          <td>Name</td>
                          <th>{{ $order->merchant_id && $order->merchant->name ? $order->merchant->name : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Phone</td>
                          <th>{{ $order->merchant_id && $order->merchant->phone ? $order->merchant->phone : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Address</td>
                          <td>{{ $order->merchant_id && $order->merchant->address ? $order->merchant->address : '-' }}</td>
                      </tr>
                  </table>
              </div>
              <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                  <!-- <div style="position:absolute; right: 14px; top: -6px;"> -->
                  <h3 class="card-title">Customer</h3>
                  <table class="table table-borderless table-responsive">
                      <tr>
                          <td>Name</td>
                          <th>{{ $order->customer_name }}</th>
                      </tr>
                      <tr>
                          <td>Phone</td>
                          <th>{{ $order->customer_telp }}</th>
                      </tr>
                      <tr>
                          <td>Address</td>
                          <td>{{ $order->customer_address }}</td>
                      </tr>
                      @if(strlen($order->customer_notes)>1)
                      <tr>
                          <td>Notes</td>
                          <td>{{ $order->customer_notes }}</td>
                      </tr>
                      @endif
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
                      <!-- <h4>
                      <i class="fas fa-cart-arrow-down"></i> {{ $order->customer_name }}
                      <small class="float-right">Date: {{ date('d/m/Y', strtotime($order->created_at)); }}</small>
                      </h4> -->
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
                              <th>Name</th>
                              <th>Price</th>
                              <th>Discount</th>
                              <th>Discount Type</th>
                              <th>Qty.</th>
                              <th>Total Price</th>
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
                  <div class="col-12 col-lg-4 col-md-4 col-sm-12 mt-2">
                      <h3 class="card-title">Distance Info</h3>
                      <table class="table table-borderless table-responsive">
                          <tr>
                              <td style="widtd:50%">Distance</td>
                              <td>{{ $order->distance }} Km.</td>
                          </tr>
                          <tr>
                              <td>Total Distance Price</td>
                              <td>{{ number_format($order->total_distance_price,0,',','.') }}</td>
                          </tr>
                      </table>
                  </div>
                  <div class="col-12 col-lg-4 col-md-4 col-sm-12 mt-2">
                      <h3 class="card-title">Payment Info</h3>
                      <table class="table table-borderless table-responsive">
                          <tr>
                              <td>Payment Type</td>
                              <td>{{ ucfirst($order->payment_type) }}</td>
                          </tr>
                          <tr>
                              <td>Payment Status</td>
                              <td>{{ ucfirst($order->payment_status) }}</td>
                          </tr>
                          <tr>
                              <td>Bank Name</td>
                              <td>{{ $order->payment_bank_name }}</td>
                          </tr>
                          <tr>
                          <td>Bank Account No.</td>
                          <td>{{ $order->payment_account_number }}</td>
                          </tr>
                          <tr>
                              <td>Payment Total</td>
                              <td>{{ number_format($order->payment_total,0,',','.') }}</td>
                          </tr>
                      </table>
                  </div>
                  <div class="col-12 col-lg-4 col-md-4 col-sm-12 mt-2">
                      <h3 class="card-title">Total</h3>
                      <table class="table table-borderless table-responsive">
                          <tr>
                              <td style="widtd:50%">Total Item:</td>
                              <th>{{ $order->total_item }}</th>
                          </tr>
                          <tr>
                              <td>Total Item Price:</td>
                              <th>{{ number_format($order->total_item_price,0,',','.') }}</th>
                          </tr>
                          <tr>
                              <td>Total Price:</td>
                              <th>{{ number_format($order->total_price,0,',','.') }}</th>
                          </tr>
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
                          <td>Name</td>
                          <th>{{ $order->courier_id ? $order->courier->name : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Phone</td>
                          <th>{{ $order->courier_id ? $order->courier->phone : '-' }}</th>
                      </tr>
                  </table>
              </div>
          </div>
      </div>
    </div>

    <div class="main-card mb-3 card" style="border-radius: 1.5em;">
       <div class="card-body p-4">
           <div class="row">
               <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                   <h3 class="card-title">Status Order</h3>

               </div>
           </div>
       </div>
     </div>
   @include('sweetalert::alert')
 </div>
@endsection

@extends('layouts.app-admin')

@section('content')
<style>

</style>
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-news-paper icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Orders <span class="badge badge-pill badge-primary">{{ number_format($orders->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Orders</div></div>
         </div>
         <div class="page-title-actions">
             <a href="#" class="btn-shadow btn btn-info btn-lg">Add Order</a>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body" style="display: grid;">
        <div class="row mb-3">
          <div class="col-12 col-md-5">
            <div class="d-flex">
              <form class="form-inline" method="GET">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-search fa-w-16"></i>
                    </div>
                  </div>
                  <input id="filter" name="filter" value="{{ $filter }}" autocomplete="off" placeholder="Search Order" type="text" class="form-control" style="color: gray;">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-primary btn-md">Search</button>
                  </div>
                </div>
              </form>
              <form class="form-inline" method="GET">
                <button class="btn btn-light btn-lg ml-2">Clear</button>
              </form>
            </div>
          </div>
        </div>

        <div style="overflow-x:auto;">
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                  <th rowspan="2" style="min-width: 50px;">@sortablelink('id', 'ID')</th>
                  <th rowspan="2" style="min-width: 60px;">@sortablelink('order_type', 'Type')</th>
                  <th rowspan="2" style="min-width: 140px;">Merchant</th>
                  <th colspan="2" style="">Customer</th>
                  <th colspan="4" style="width: 40%;">Total</th>
                  <th colspan="2" style="width: 20%;">Payment</th>
                  <th rowspan="2" style="min-width: 120px;">Courier</th>
                  <th rowspan="2" style="min-width: 100px;">@sortablelink('status', 'Status')</th>
                  <th rowspan="2" style="min-width: 100px;;">Action</th>
              </tr>
              <tr>
                  <th style="min-width: 120px;">@sortablelink('customer_name', 'Name/Telp')</th>
                  <th style="min-width: 160px;">@sortablelink('customer_address', 'Address')</th>
                  <!-- <th style="text-align: center">Notes</td> -->
                  <th style="min-width: 60px;">@sortablelink('total_item', 'Pcs')</th>
                  <th style="min-width: 120px;">@sortablelink('total_item_price', 'Item Price')</th>
                  <th style="min-width: 140px;">@sortablelink('total_distance_price', 'Distance Price')</th>
                  <th style="min-width: 120px;">@sortablelink('total_price', 'Total Price')</th>
                  <th style="">@sortablelink('payment_type', 'Type')</th>
                  <th style="">@sortablelink('payment_status', 'Status')</th>
              </tr>
            </thead>
             <tbody>
               @if ($orders->count() == 0)
               <tr>
                 <td colspan="14">No order to display.</td>
               </tr>
               @endif
                 @foreach ($orders as $order)
                     <tr>
                         <td>{{ $order->id }}</td>
                         @if($order->order_type == 'borneos')
                         <td><span class="badge badge-pill badge-warning">{{ $order->order_type }}</span></td>
                         @elseif($order->order_type == 'bonjek')
                         <td><span style="background-color: palevioletred" class="badge badge-pill badge-info">{{ $order->order_type }}</span></td>
                         @elseif($order->order_type == 'legenda')
                         <td><span class="badge badge-pill badge-danger">{{ $order->order_type }}</span></td>
                         @else
                         <td><span class="badge badge-pill badge-secondary">{{ $order->order_type }}</span></td>
                         @endif
                         <td><span>{{ $order->merchant_id && $order->merchant->name ? $order->merchant->name : '-' }}</span></td>
                         <td>
                           <small style="font-weight: bold;">{{ $order->customer_name ? \Str::limit($order->customer_name, 13, '..') : '-' }}</small></br>
                           <small>{{ $order->customer_telp }}</small>
                         </td>

                         <td title="{{ $order->customer_address }}"><span style="font-size: 12px;">{{ $order->customer_address ? \Str::limit($order->customer_address, 45, '..') : '-' }}</span></td>
                         <!-- <td title="{{ $order->customer_notes }}">{{ $order->customer_notes ? \Str::limit($order->customer_notes, 15, '..'): '-' }}</td> -->
                         <td>{{ $order->total_item }}</td>
                         <td>{{ $order->total_item_price }}</td>
                         <td>{{ $order->total_distance_price }}</td>
                         <td>{{ $order->total_price }}</td>
                         @if($order->payment_type == 'cash')
                         <td><span class="badge badge-pill badge-success">{{ $order->payment_type }}</span></td>
                         @elseif($order->payment_type == 'transfer')
                         <td><span class="badge badge-pill badge-primary">{{ $order->payment_type }}</span></td>
                         @else
                         <td><span class="badge badge-pill badge-secondary">{{ $order->payment_type }}</span></td>
                         @endif
                         @if($order->payment_status == 'paid')
                         <td><span class="badge badge-pill badge-success">{{ $order->payment_status }}</span></td>
                         @else
                         <td><span class="badge badge-pill badge-danger">{{ $order->payment_status }}</span></td>
                         @endif
                         <td>{{ $order->courier_id && $order->courier->name ? $order->courier->name : '-' }}</td>
                         @if($order->status == 'new')
                         <td><span class="badge badge-pill badge-info">{{ $order->status }}</span></td>
                         @else
                         <td><span class="badge badge-pill badge-success">{{ $order->status }}</span></td>
                         @endif
                         <td>
                            <!-- Dropdown -->
                             <div class="dropdown">
                                 <button class="btn btn-primary dropdown-toggle" type="button"
                                         id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                         aria-expanded="false">
                                         <i class="pe-7s-settings"></i>
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                     <a class="dropdown-item" href="#"><i class="pe-7s-user"></i>&nbsp;Details</a>
                                     <a class="dropdown-item" href="#"> <i class="text-dark pe-7s-note"></i>&nbsp;Edit</a>
                                     <a class="dropdown-item" href="#"> <i class="pe-7s-power"></i>&nbsp;Cancel</a>
                                 </div>
                             </div>
                             <!-- End Dropdown -->
                         </td>
                     </tr>
                 @endforeach
             </tbody>
          </table>
        </div>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $orders->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$orders->count()}} of {{ number_format($orders->total(), 0, "", ".") }} order</p>
            </div>
          </div>
      </div>
   </div>
   @include('sweetalert::alert')
 </div>
@endsection

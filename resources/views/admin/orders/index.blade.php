@extends('layouts.app-admin')

@section('content')
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
      <div class="card-body">
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
         <table style="width: 100%;" class="table table-hover table-striped table-bordered">
            <tr>
                <th rowspan="2">ID</th>
                <th rowspan="2" style="text-align: center">Type</th>
                <th rowspan="2">Merchant</th>
                <th colspan="4" style="text-align: center">Customer</th>
                <th colspan="4" style="text-align: center">Total</th>
                <th colspan="2" style="text-align: center">Payment</th>
                <th rowspan="2">Courier</th>
                <th rowspan="2" style="text-align: center">Status</th>
                <th rowspan="2">Action</th>
            </tr>
            <tr>
                <th style="text-align: center">Name</th>
                <th style="text-align: center">Telp</td>
                <th style="text-align: center">Address</th>
                <th style="text-align: center">Notes</td>
                <th style="text-align: center">Item</th>
                <th style="text-align: center">Item Price</th>
                <th style="text-align: center">Distance</th>
                <th style="text-align: center">Price</th>
                <th style="text-align: center">Type</th>
                <th style="text-align: center">Status</th>
            </tr>
            <tbody>
              @if ($orders->count() == 0)
              <tr>
                <td colspan="8">No order to display.</td>
              </tr>
              @endif
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        @if($order->order_type == 'borneos')
                        <td><span class="mr-3 ml-3 badge badge-pill badge-warning">{{ $order->order_type }}</span></td>
                        @elseif($order->order_type == 'bonjek')
                        <td><span style="background-color: palevioletred" class="mr-3 ml-3 badge badge-pill badge-info">{{ $order->order_type }}</span></td>
                        @elseif($order->order_type == 'legenda')
                        <td><span class="mr-3 ml-3 badge badge-pill badge-danger">{{ $order->order_type }}</span></td>
                        @else
                        <td><span class="mr-3 ml-3 badge badge-pill badge-secondary">{{ $order->order_type }}</span></td>
                        @endif
                        <td>{{ $order->merchant_id && $order->merchant->name ? $order->merchant->name : '-' }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_telp }}</td>
                        <td title="{{ $order->customer_address }}">{{ $order->customer_address ? \Str::limit($order->customer_address, 10, '..') : '-' }}</td>
                        <td title="{{ $order->customer_notes }}">{{ $order->customer_notes ? \Str::limit($order->customer_notes, 15, '..'): '-' }}</td>
                        <td>{{ $order->total_item }}</td>
                        <td>{{ $order->total_item_price }}</td>
                        <td>{{ $order->total_distance_price }}</td>
                        <td>{{ $order->total_price }}</td>
                        @if($order->payment_type == 'cash')
                        <td><span class="mr-3 ml-3 badge badge-pill badge-success">{{ $order->payment_type }}</span></td>
                        @elseif($order->payment_type == 'transfer')
                        <td><span class="mr-2 ml-2 badge badge-pill badge-primary">{{ $order->payment_type }}</span></td>
                        @else
                        <td><span class="mr-2 ml-2 badge badge-pill badge-secondary">{{ $order->payment_type }}</span></td>
                        @endif
                        @if($order->payment_status == 'paid')
                        <td><span class="mr-3 ml-3 badge badge-pill badge-success">{{ $order->payment_status }}</span></td>
                        @else
                        <td><span class="mr-3 ml-3 badge badge-pill badge-danger">{{ $order->payment_status }}</span></td>
                        @endif
                        <td style="text-align: center">{{ $order->courier_id && $order->courier->name ? $order->courier->name : '-' }}</td>
                        @if($order->status == 'new')
                        <td><span class="mr-3 ml-3 badge badge-pill badge-info">{{ $order->status }}</span></td>
                        @else 
                        <td><span class="mr-3 ml-3 badge badge-pill badge-success">{{ $order->status }}</span></td>
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

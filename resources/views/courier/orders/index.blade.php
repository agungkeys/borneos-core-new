@extends('layouts.app-courier')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-news-paper icon-gradient bg-tempting-azure"></i>
            </div>
            <div><span style="text-transform: capitalize">{{$status ?? 'all'}}</span> Orders <span class="badge badge-pill badge-primary">{{ number_format($orders->total(), 0, "", ".") }}</span><div class="page-title-subheading">List <span style="text-transform: capitalize">{{$status ?? 'all'}} </span>Orders</div></div>
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
                  <th style="min-width: 50px;">@sortablelink('id', 'ID')</th>
                  <th style="min-width: 60px;">@sortablelink('order_type', 'Tipe')</th>
                  <th style="min-width: 140px;">Merchant</th>
                  <th style="min-width: 120px;">Telp Merchant</th>
                  <th style="min-width: 120px;">@sortablelink('customer_name', 'Customer')</th>
                  <th style="min-width: 60px;">@sortablelink('total_item', 'Pcs')</th>
                  <th style="min-width: 120px;">@sortablelink('total_item_price', 'Total Harga')</th>
                  <th style="min-width: 150px;">@sortablelink('payment_type', 'Tipe Pembayaran')</th>
                  <th style="min-width: 160px;">@sortablelink('payment_status', 'Status Pembayaran')</th>
                  <th style="min-width: 60px;">@sortablelink('status', 'Status')</th>
                  <th style="min-width: 100px;">Aksi</th>
              </tr>

            </thead>
             <tbody>
               @if ($orders->count() == 0)
               <tr>
                 <td colspan="11">No order to display.</td>
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
                         <td><span>{{ $order->merchant_id && $order->merchant->phone ? $order->merchant->phone : '-' }}</span></td>
                         <td>
                           <small style="font-weight: bold;" title="{{ $order->customer_name }}">{{ $order->customer_name ? \Str::limit($order->customer_name, 13, '..') : '-' }}</small>
                         </td>
                         <td>{{ $order->total_item }}</td>
                         <td>{{ number_format($order->total_price,0, ",",".") }}</td>
                         @if($order->payment_type == 'cash')
                         <td><span class="badge badge-pill badge-success">{{ $order->payment_type }}</span></td>
                         @elseif($order->payment_type == 'transfer')
                         <td><span class="badge badge-pill badge-primary">{{ $order->payment_type }}</span></td>
                         @elseif(!$order->payment_type)
                         <td> - </td>
                         @else
                        <td><span class="badge badge-pill badge-secondary">{{ $order->payment_type }}</span></td>
                         @endif
                         @if($order->payment_status == 'paid')
                         <td><span class="badge badge-pill badge-success">Terbayar</span></td>
                         @else
                         <td><span class="badge badge-pill badge-danger">Belum Dibayar</span></td>
                         @endif
                         @if($order->status == 'new')
                         <td> <span class="badge badge-pill badge-info p-2">Order {{ $order->status }}</span></td>
                         @elseif($order->status == 'canceled')
                         <td> <span class="badge badge-pill badge-danger p-2">{{ $order->status }}</span></td>
                         @elseif($order->status == 'processing')
                         <td> <span class="badge badge-pill badge-success p-2">Sedang Diproses</span></td>
                         @else
                         <td> <span class="badge badge-pill badge-success p-2">Terkirim</span></td>
                         @endif
                         <td>
                          <a href="{{ route('courier.master-order.detail',$order) }}" class="btn btn-primary btn-sm ion-android-clipboard" title="Details ?"></a>
                          {{-- <a href="#" class="btn btn-warning btn-sm ion-android-create" title="Edit ?"></a> --}}
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

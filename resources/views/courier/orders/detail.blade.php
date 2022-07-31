@extends('layouts.app-courier')

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
       <a href="/courier/orders/all" class="text-secondary mb-3" style="display: flex; align-items: center; text-decoration: none;"><i class="pe-7s-angle-left" style="font-size: 2rem;"></i>Kembali ke List Pesanan</a>
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
         @elseif($order->status == 'processing')
         <p class="badge badge-success p-2">Sedang Diproses</p>
         @else
         <p class="badge badge-success p-2">Terkirim</p>
         @endif

         @if($order->payment_status == 'paid')
         <p class="badge badge-success p-2">Terbayar</p>
         @else
         <p style="background-color: red" class="badge badge-secondary p-2">Belum Dibayar</p>
         @endif
       </div>
     </div>
   </div>

   <div class="main-card mb-3 card" style="border-radius: 1.5em;">
      <div class="card-body p-4">
          <div class="row d-flex justify-content-between">
              <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                  <h3 class="card-title">Informasi Merchant</h3>
                  <table class="table table-borderless table-responsive">
                      <tr>
                          <td>Nama</td>
                          <th>{{ $order->merchant_id && $order->merchant->name ? $order->merchant->name : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Telepon</td>
                          <th>{{ $order->merchant_id && $order->merchant->phone ? $order->merchant->phone : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Alamat</td>
                          <td>{{ $order->merchant_id && $order->merchant->address ? $order->merchant->address : '-' }}</td>
                      </tr>
                  </table>
              </div>
              <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                  <!-- <div style="position:absolute; right: 14px; top: -6px;"> -->
                  <h3 class="card-title">Customer</h3>
                  <table class="table table-borderless table-responsive">
                      <tr>
                          <td>Nama</td>
                          <th>{{ $order->customer_name }}</th>
                      </tr>
                      <tr>
                          <td>Telepon</td>
                          <th>{{ $order->customer_telp }}</th>
                      </tr>
                      <tr>
                          <td>Alamat</td>
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
                    <h3 class="card-title">Informasi Produk</h3>
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
                              <th>Diskin</th>
                              <th>Tipe Diskon</th>
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
              <div class="row">
                  <div class="col-12 col-lg-4 col-md-4 col-sm-12 mt-2">
                      <h3 class="card-title">Ongkir</h3>
                      <table class="table table-borderless table-responsive">
                          <tr>
                              <td style="widtd:50%">Jarak</td>
                              <td>{{ $order->distance }} Km.</td>
                          </tr>
                          <tr>
                              <td>Total Ongkir</td>
                              <td>{{ number_format($order->total_distance_price,0,',','.') }}</td>
                          </tr>
                      </table>
                  </div>
                  <div class="col-12 col-lg-4 col-md-4 col-sm-12 mt-2">
                      <h3 class="card-title">Informasi Pembayaran</h3>
                      <table class="table table-borderless table-responsive">
                          <tr>
                              <td>Tipe Pembayaran</td>
                              <td>{{ ucfirst($order->payment_type) }}</td>
                          </tr>
                          <tr>
                              <td>Status Pembayaran</td>
                              <td>{{ ucfirst($order->payment_status) }}</td>
                          </tr>
                          <tr>
                              <td>Nama Bank</td>
                              <td>{{ $order->payment_bank_name }}</td>
                          </tr>
                          <tr>
                              <td>No Rekening Bank</td>
                              <td>{{ $order->payment_account_number }}</td>
                          </tr>
                          <tr>
                              <td>Total Pembayaran</td>
                              <td>{{ number_format($order->payment_total,0,',','.') }}</td>
                          </tr>
                      </table>
                  </div>
                  <div class="col-12 col-lg-4 col-md-4 col-sm-12 mt-2">
                      <h3 class="card-title">Total</h3>
                      <table class="table table-borderless table-responsive">
                          <tr>
                              <td style="widtd:50%">Total Qty :</td>
                              <th>{{ $order->total_item }}</th>
                          </tr>
                          <tr>
                              <td>Total Harga Item :</td>
                              <th>{{ number_format($order->total_item_price,0,',','.') }}</th>
                          </tr>
                          <tr>
                              <td>Total Akhir :</td>
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
                  <h3 class="card-title">Informasi Kurir</h3>
                  <table class="table table-borderless table-responsive">
                      <tr>
                          <td>Nama</td>
                          <th>{{ $order->courier_id ? $order->courier->name : '-' }}</th>
                      </tr>
                      <tr>
                          <td>Telepon</td>
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
                   <h3 class="card-title">Status Pesanan</h3>
               </div>
           </div>
           <form action="{{ route('courier.master-order.detail.update',$order) }}" method="post">
               @method('PUT')
               @csrf
               <div class="row mt-2">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status </label>
                            @if ($order->status == 'delivered')
                            <div class="alert alert-success" style="border-radius: 10px"><b>Terkirim</b></div>
                            @else
                            <div class="alert alert-info" style="border-radius: 10px"><b>Sedang Proses</b></div>
                            @endif
                        </div>
                    </div>
                    @if ($order->status == 'delivered')
                    @else
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="deliver_status">Update Status Pesanan</label>
                                <select name="deliver_status" id="deliver_status" class="form-control">
                                    <option disabled>Pilih Status Pesanan</option>
                                    <option {{ $order->status == 'proccesing' ? 'selected':'' }} value="processing">Sedang Proses</option>
                                    <option {{ $order->status == 'delivered' ? 'selected':'' }} value="delivered">Terkirim</option>
                                </select>
                            </div>
                        </div>
                    @endif
               </div>
                <div class="text-right mt-2">
                    <a href="/courier/orders/all" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                    @if ($order->status == 'delivered')

                    @else
                    <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                    @endif
                </div>
           </form>
       </div>
     </div>
   @include('sweetalert::alert')
 </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            let PaymentMethod = $('#status').val();
            onChangePaymentStatus($('#deliver_status').val());
            $('#deliver_status').change(function(e){
                onChangePaymentStatus(e.target.value);
            });
        });
        function capitalize(s) {
            return s[0].toUpperCase() + s.substr(1);
        }
        function onChangePaymentStatus(val){
             if(val == 'delivered'){
                $('#status').attr('class','alert alert-success');
                $('#status').html('<b>Terkirim</b>');
            }else{
                $('#status').attr('class','alert alert-info');
                $('#status').html('<b>Sedang Proses</b>');
            }
        }
    </script>
@endsection

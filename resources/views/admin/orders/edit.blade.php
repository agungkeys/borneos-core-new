@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-news-paper icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Edit Order<div class="page-title-subheading">Invoice No. INV/{{ $order->id }}/{{date('d/m/Y', strtotime($order->created_at));}}/{{ $order->prefix }}</div></div>
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
                   <h3 class="card-title">Status Order & Payment</h3>
               </div>
           </div>
           <form action="{{ route('admin.orders.update',$order) }}" method="post">
                @method('PUT')
                @csrf
               <div class="row mt-2">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Order Status: </label>
                            <div id="order_status" style="border-radius: 10px"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Update Order Status:</label>
                            <select name="status" id="status" class="js-data-example-ajax multiselect-dropdown form-control">
                                {{-- <option {{ $order->status == 'new' ? 'selected':'' }} value="new">New</option>
                                <option {{ $order->status == 'otw' ? 'selected':'' }} value="otw">Otw</option>
                                <option {{ $order->status == 'canceled' ? 'selected':'' }} value="canceled">Cancel</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="status_notes">Status Notes:</label>
                        <input type="text" name="status_notes" id="status_notes" value="{{ $order->status_notes }}" class="form-control" placeholder="Status Notes">
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-3">
                        <label>Payment Status:</label>
                        <div id="status_payment" style="border-radius:10px"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment_status">Update Payment Status:</label>
                            <select name="payment_status" id="payment_status" class="js-data-example-ajax multiselect-dropdown form-control">
                                <!-- <option {{ $order->payment_status == 'paid' ? 'selected':'' }} value="paid">Paid</option>
                                <option {{ $order->payment_status == 'unpaid' ?'selected':'' }} value="unpaid">Unpaid</option> -->
                            </select>
                        </div>
                    </div>
                    @if($order->status != 'new')
                    <div class="col-md-5" id="form_courier">
                        <div class="form-group">
                            <label for="courier">Choose Courier:</label>
                            <select name="courier" id="courier" class="js-data-example-ajax multiselect-dropdown form-control">
                                    <option value="">Choose One!</option>
                                @foreach ($couriers as $courier)
                                    <option {{ $order->courier_id == $courier->id ? 'selected':'' }} value="{{ $courier->id }}">{{ $courier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    @endif
               </div>
                <div class="text-right mt-2">
                    <a href="/admin/orders" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                    <button type="submit" id="btnUpdate" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                </div>
           </form>
       </div>
     </div>
   @include('sweetalert::alert')
 </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            let orderStatus = '{{ $order->status }}', paymentStatus = '{{ $order->payment_status }}';
            if(orderStatus == 'new'){
                $('#form_courier').hide();
                alertPaymentStatusOrder('new');
                $('#status').append("<option value=''>Choose One!</option><option value='processing'>Processing</option><option value='cancel'>Cancel</option>");
            }else if(orderStatus == 'processing'){
                alertPaymentStatusOrder('processing');
                $('#status').append("<option value=''>Choose One!</option><option value='otw'>Otw</option><option value='cancel'>Cancel</option>");
            }else if(orderStatus == 'otw'){
                alertPaymentStatusOrder('otw');
                $('#status').append("<option value=''>Choose One!</option><option value='delivered'>Delivered</option><option value='refund'>Refund</option>");
            }else if(orderStatus == 'delivered'){
                alertPaymentStatusOrder('delivered');
                $('#status').append("<option value=''>Choose One!</option><option value='done'>Done</option>");
            }else if(orderStatus == 'refund'){
                alertPaymentStatusOrder('refund');
                $('#status').append("<option value='refund'>Refund</option>");
            }else if(orderStatus == 'cancel'){
                $('#form_courier').hide();
                alertPaymentStatusOrder('cancel');
                $('#status').append("<option value='cancel'>Cancel</option>");
            }else if(orderStatus == 'done'){
                alertPaymentStatusOrder('done');
                $('#status').append("<option value='done'>Done</option>");
            };

            if(paymentStatus == 'unpaid'){
                alertPaymentStatusOrder('unpaid');
                $('#payment_status').append("<option value=''>Choose One!</option><option value='unpaid'>Unpaid</option><option value='paid'>Paid</option>");
            }else if(paymentStatus == 'paid'){
                alertPaymentStatusOrder('paid');
                $('#payment_status').append("<option value=''>Choose One!</option><option value='paid'>Paid</option><option value='unpaid'>Unpaid</option>");
            }

            $('#status').change(function(e){
                let value = e.target.value;
                if(value == 'processing'){
                    $('#form_courier').show();
                }else if(value == 'cancel'){
                    $('#form_courier').hide();
                }else if(value == 'otw'){
                    if($('#courier').val() != ''){
                        $('#btnUpdate').attr('disabled',false);
                    }else{
                        $('#btnUpdate').attr('disabled',true);
                    }
                };
                alertPaymentStatusOrder(value);
            });
            $('#payment_status').change(function(e){
                let value = e.target.value;
                if(orderStatus == 'new'){
                    if(value == 'paid'){
                        $('#form_courier').show();
                        $('#status').empty();
                        $('#status').append("<option value='processing'>Processing</option>");
                        alertPaymentStatusOrder('processing');
                    }
                };
                alertPaymentStatusOrder(value);
            });
            $('#courier').change(function(){
                let orderStatusCurrent = $('#status').val();
                if(orderStatus || orderStatusCurrent == 'processing'){
                    alertPaymentStatusOrder('otw');
                    $('#status').empty();
                    $('#status').append("<option value='otw'>Otw</option><option value='cancel'>Cancel</option>");
                    $('#btnUpdate').attr('disabled',false);
                }
            });
        });
        function alertPaymentStatusOrder(val){
             if(val == 'new'){
                $('#order_status').attr('class','alert alert-info');
                $('#order_status').html('<b>New</b>');
            }else if(val == 'otw'){
                $('#order_status').attr('class','alert alert-warning');
                $('#order_status').html('<b>Otw</b>');
            }else if(val == 'cancel'){
                $('#order_status').attr('class','alert alert-danger');
                $('#order_status').html('<b>Cancel</b>');
            }else if(val == 'paid'){
                $('#status_payment').attr('class','alert alert-success');
                $('#status_payment').html('<b>Paid</b>');
            }else if(val == 'unpaid'){
                $('#status_payment').attr('class','alert alert-danger');
                $('#status_payment').html('<b>Unpaid</b>');
            }else if(val == 'delivered'){
                $('#order_status').attr('class','alert alert-success');
                $('#order_status').html('<b>Delivered</b>');
            }else if(val == 'refund'){
                $('#order_status').attr('class','alert alert-success');
                $('#order_status').html('<b>Refund</b>');
            }else if(val == 'processing'){
                $('#order_status').attr('class','alert alert-success');
                $('#order_status').html('<b>Processing</b>');
            }else if(val == 'done'){
                $('#order_status').attr('class','alert alert-success');
                $('#order_status').html('<b>Done</b>');
            }
        }
    </script>
@endsection

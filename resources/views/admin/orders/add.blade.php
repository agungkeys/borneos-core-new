@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-news-paper icon-gradient bg-tempting-azure"></i>
            </div>
            Add Order
         </div>
      </div>
   </div>

   <div class="main-card mb-3 card">
      <div class="card-body">
         <form action="{{ route('admin.orders.store') }}" method="POST" autocomplete="off">
            @csrf
             <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name">
                        @error('customer_name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="customer_telp">Customer Telp</label>
                        <input type="number" name="customer_telp" id="customer_telp" class="form-control" placeholder="Customer Telp">
                        @error('customer_telp')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="customer_address">Customer Address</label>
                        <textarea style="font-size: 14px" name="customer_address" id="customer_address" class="form-control" placeholder="Customer Address"></textarea>
                        @error('customer_address')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="customer_notes">Customer Notes <small>(optional)</small></label>
                        <textarea style="font-size: 14px" name="customer_notes" id="customer_notes" class="form-control" placeholder="Customer Notes"></textarea>
                        @error('customer_notes')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>               
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="merchant">Merchant</label>
                        <select name="merchant" id="merchant" class="js-data-example-ajax multiselect-dropdown form-control" required>
                            <option disabled selected value="">Choose One!</option>
                            @foreach ($merchants as $merchant)
                                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                            @endforeach
                        </select>
                        @error('merchant')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                       <label for="order_type">Order Type</label>
                       <select name="order_type" id="order_type" class="js-data-example-ajax multiselect-dropdown form-control" required>
                           <option disabled selected value="">Choose One!</option>
                           <option value="borneos">Borneos</option>
                           <option value="bonjek">Bonjek</option>
                           <option value="legenda">Legenda</option>
                           <option value="external">External</option>
                       </select>
                       @error('order_type')
                           <div class="text-danger mt-2">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
                <div class="col-md-4">
                    <label for="courier">Courier</label>
                    <select name="courier" id="courier" class="js-data-example-ajax multiselect-dropdown form-control">
                        <option disabled selected value="">Choose One!</option>
                        @foreach ($couriers as $courier)
                            <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="distance">Distance</label>
                        <input type="number" name="distance" id="distance" class="form-control" placeholder="Distance">
                        @error('distance')
                           <div class="text-danger mt-2">{{ $message }}</div>
                       @enderror
                    </div>
                 </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_item">Total Item</label>
                        <input type="number" name="total_item" id="total_item" class="form-control" placeholder="Total Item">
                        @error('total_item')
                           <div class="text-danger mt-2">{{ $message }}</div>
                       @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Coordinat Google Maps</label>
                        <div class="input-group">
                            <input style="font-size: 12px" type="text" id="latitude" name="latitude"  class="form-control" placeholder="Latitude" readonly>
                            <input style="font-size: 12px" type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" readonly>
                            <div class="input-group-append">
                                <button type="button" id="btnCoordinate" class="btn btn-success" data-toggle="modal" data-target="#addCoordinate">Add Coordinate</button>
                            </div>
                        </div>
                        @error('latitude')
                           <div class="text-danger mt-2">{{ $message }}</div>
                       @enderror
                       @error('longitude')
                           <div class="text-danger mt-2">{{ $message }}</div>
                       @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_distance_price">Total Distance Price</label>
                        <input type="number" name="total_distance_price" id="total_distance_price" class="form-control" placeholder="Total Distance Price">
                        @error('total_distance_price')
                            <div class="text-danger mt-2">{{ $message }}</div>    
                        @enderror
                    </div>
                 </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_item_price">Total Item Price</label>
                        <input type="number" name="total_item_price" id="total_item_price" class="form-control" placeholder="Total Item Price">
                        @error('total_item_price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_price">Total Price</label>
                        <input type="number" name="total_price" id="total_price" class="form-control" placeholder="Total Price" readonly>
                        @error('total_price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="payment_type">Payment Type</label>
                        <select name="payment_type" id="payment_type" class="js-data-example-ajax multiselect-dropdown form-control">
                            <option disabled selected value="">Choose One!</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="digital">Digital</option>
                        </select>
                        @error('payment_type')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="js-data-example-ajax multiselect-dropdown form-control">
                            <option disabled selected value="">Choose One!</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                        @error('payment_status')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="payment_total">Payment Total</label>
                        <input type="number" name="payment_total" id="payment_total" class="form-control" placeholder="Payment Total">
                        @error('payment_total')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="payment_bank_name">Payment Bank Name</label>
                        <input type="text" name="payment_bank_name" id="payment_bank_name" class="form-control" placeholder="Payment Bank Name">
                        @error('payment_bank_name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="payment_account_number">Payment Account Number</label>
                        <input type="number" name="payment_account_number" id="payment_account_number" class="form-control" placeholder="Payment Account Number">
                        @error('payment_account_number')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-right mt-2">
               <a href="/admin/orders" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
               <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
            </div>
         </form>
      </div>
    </div>
@endsection
@section('extend')
<div class="modal fade" id="addCoordinate" tabindex="-1" role="dialog" aria-labelledby="addCoordinate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCoordinate">Add Coordinate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="address-input" name="address" style="font-size: 14px" class="form-control map-input" onchange="hideMaps()" autocomplete="off" placeholder="Input Customer Address">
                <input type="hidden" name="latitude" id="address-latitude"/>
                <input type="hidden" name="longitude" id="address-longitude"/><br>
                <div style="width: 100%; height: 330px; display: none;" id="address-map"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg" data-dismiss="modal" onclick="setCoordinate()"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save Coordinate</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        deleteCoordinate();
        $('#total_distance_price').keyup(function(){    
            let total_price = parseInt($('#total_distance_price').val()) + parseInt($('#total_item_price').val());
            $('#total_price').val(total_price);
            $('#payment_total').val(total_price);
        });
        $('#total_item_price').keyup(function(){
            let total_price = parseInt($('#total_item_price').val()) + parseInt($('#total_distance_price').val());
            $('#total_price').val(total_price);
            $('#payment_total').val(total_price);
        });
    });
    function hideMaps(){
        document.getElementById('address-map').style.display ="";
    }
    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    let lat = getCookie("lat");
    let lng = getCookie("lng");
    document.getElementById('address-latitude').value = lat;
    document.getElementById('address-longitude').value = lng;
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
    if(lat != ""){
        document.getElementById('btnCoordinate').innerHTML= "Edit Coordinate"
    }else{
        document.getElementById('btnCoordinate').innerHTML= "Add Coordinate"
    }
</script>
@endsection

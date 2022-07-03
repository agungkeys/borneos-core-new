@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Add Order
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="main-card mb-3 card">
      <div class="card-body">
         <form action="{{ route('admin.master-product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                       <label for="order_type">Order Type</label>
                       <select name="order_type" id="order_type" class="js-data-example-ajax multiselect-dropdown form-control">
                           <option disabled selected value="">Choose One!</option>
                           <option value="external">External</option>
                           <option value="bonjek">Bonjek</option>
                           <option value="legenda">Legenda</option>
                       </select>
                   </div>
               </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="merchant_id">Merchant</label>
                        <select name="merchant_id" id="merchant_id" class="js-data-example-ajax multiselect-dropdown form-control">
                            <option disabled selected value="">Choose One!</option>
                            <option value="">Merchant 1</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="price">Customer Name</label>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Customer Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="customer_telp">Customer Telp</label>
                        <input type="number" name="customer_telp" id="customer_telp" class="form-control" placeholder="Customer Telp">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="discount">Customer Address</label>
                        <textarea style="font-size: 12px" name="customer_address" id="customer_address" class="form-control" placeholder="Customer Address"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Edit Koordiant</label>
                        <div class="input-group">
                            <input style="font-size: 12px" type="text" id="latitude" name="latitude" value="0.14311553211432268" class="form-control" placeholder="Latitude" readonly>
                            <input style="font-size: 12px" type="text" id="longitude" name="longitude" value="117.4628838675546" class="form-control" placeholder="Longitude" readonly>
                            <div class="input-group-append">
                                <button type="button" id="btnCoordinate" class="btn btn-success" data-toggle="modal" data-target="#addCoordinate">Ubah Koordinat</button>
                            </div>
                        </div>
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
@section('js')
   <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&v=3.45.8"></script>
<script type="text/javascript">
     let myLatlng = { lat:23.757989, lng:90.360587};
     console.log(myLatlng);
     let test = document.getElementById('map');
        let map = new google.maps.Map(test, {
                zoom: 13,
                center: myLatlng,
            });
        var zonePolygon = null;
        let infoWindow = new google.maps.InfoWindow({
                content: "Click the map to get Lat/Lng!",
                position: myLatlng,
            });
        var bounds = new google.maps.LatLngBounds();
        function initMap() {
            // Create the initial InfoWindow.
            infoWindow.open(map);
             //get current location block
             infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                    myLatlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    infoWindow.setPosition(myLatlng);
                    infoWindow.setContent("Location found.");
                    infoWindow.open(map);
                    map.setCenter(myLatlng);
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
            // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
            //-----end block------
        }
        initMap();
          function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }
</script>

@endsection

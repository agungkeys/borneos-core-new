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
               Add Master Product
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
                        <label for="merchant_id">Merchant</label>
                        <select name="merchant_id" id="merchant_id" class="js-data-example-ajax multiselect-dropdown form-control" onchange="getMerchantData(this.value)" required title="Select Merchant">
                            <option disabled selected value="">Choose One!</option>
                            @foreach ($merchants as $merchant)
                                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="form-control">
                        @error('product_name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control">
                        @error('price')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="discount_type">Discount Type</label>
                        <select class="multiselect-dropdown form-control" name="discount_type" id="discount_type" required>
                            <option disabled selected value="">Choose One!</option>
                            <option value="percent">Percent</option>
                            <option value="amount">Amount</option> 
                        </select>
                        @error('discount_type')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="discount">Discount</label>
                       <input type="number" name="discount" id="discount" class="form-control">
                    </div>
                    @error('discount')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="hidden" id="category" name="category">
                        <input type="text" id="category_name" class="form-control" readonly>    
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="sub_category">Sub Category</label>
                        <select class="multiselect-dropdown form-control" name="sub_category" id="sub_category" onchange="get_sub_category(this.value)" required>
                            <option disabled selected value="">Choose One!</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="sub_sub_category">Sub Sub Category</label>
                        <select class="multiselect-dropdown form-control" name="sub_sub_category" id="sub_sub_category">
                            <option disabled selected value="">Choose One!</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-md-6">
                    <div class="form-group">
                       <label for="attribute">Attribute</label>
                        <select class="multiselect-dropdown form-control" name="attribute" id="attribute">
                           <option disabled selected value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-md-6">
                    <div class="form-group">
                       <label for="addon">Addon</label>
                        <select class="multiselect-dropdown form-control" name="addon" id="addon">
                            <option disabled selected value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="available_time_starts">Available time starts</label>
                        <input type="time" name="available_time_starts" class="form-control" id="available_time_starts" placeholder="Ex : 08:30 am" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="available_time_ends">Available time ends</label>
                        <input type="time" name="available_time_ends" class="form-control" id="available_time_ends" placeholder="Ex : 10:30 am" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Short Description</label>
                        <textarea type="text" name="description" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
               <label for="image">Image</label><br>
               <input type="file" accept="image/*" id="image" name="image">
               @error('image')
                  <br><span class="text-danger mt-2">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group text-center" style="margin-bottom:0%;">
               <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
            </div>
            <div class="text-right mt-2">
               <a href="{{ route('admin.master-product') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
               <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
            </div>
         </form>
      </div>
   </div>
     <script>
         function getMerchantData(id){
             $.get('/admin/get-merchants/'+id,function(response){
                $('#category').val(response.category);
                $('#category_name').val(response.category_name);
                $.each(response.sub_categories, function (i, item) {
                    $('#sub_category').append($('<option>', { 
                        value: item.id,
                        text : item.name 
                    }));
                });
             });
         }
         function get_sub_category(id){
            $.get('/admin/get-sub-sub-category/'+id,function(response){
                if(response.length == 1){
                    $('#sub_sub_category').append($('<option>', { 
                        value: item.id,
                        text : item.name 
                    }));
                }else if(response.length > 1){
                    $.each(response, function (i, item) {
                        $('#sub_sub_category').append($('<option>', { 
                            value: item.id,
                            text : item.name 
                        }));
                    });
                };
            });
         }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function () {
            readURL(this);
        });
    </script>
@endsection

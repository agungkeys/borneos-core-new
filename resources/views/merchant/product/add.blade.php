@extends('layouts.app-merchant')

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
         <form action="{{ route('merchant.master-product.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="merchant_id">Merchant</label>
                        <input type="hidden" id="merchant_id" name="merchant_id" value="{{ $merchant->id }}">
                        <input type="text" value="{{$merchant->name}}" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Product Name">
                        @error('product_name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                       <label>Slug</label>
                       <input type="text" id="slug" name="slug"  class="form-control" readonly>
                   </div>
                 </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Price">
                        @error('price')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="discount_type">Discount Type</label>
                        <select class="multiselect-dropdown form-control" name="discount_type" id="discount_type">
                            <option selected value="">Choose One!</option>
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
                       <input type="number" name="discount" id="discount" class="form-control" placeholder="Discount">
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
                        <input type="text" id="category_name" class="form-control" disabled>
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
                        <label>Favorite</label><br>
                        <label class="m-auto align-middle" for="favorite">
                           <input type="checkbox" data-toggle="toggle" data-size="normal" name="favorite" id="favorite">
                       </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
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
                <a href="{{ route('merchant.master-product') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
            </div>
         </form>
      </div>
   </div>
@endsection
@section('js')
    <script>
        $.get('/get-merchants/{{$merchant->id}}',function(response){
            $('#category').val(response.category);
            $('#category_name').val(response.category_name);
            $.each(response.sub_categories, function (i, item) {
                $('#sub_category').append($('<option>', {
                    value: item.id,
                    text : item.name
                }));
            });
        });
        function get_sub_category(id){
            $.get('/get-sub-sub-category/'+id,function(response){
                $('#sub_sub_category').empty();
                $.each(response, function (i, item) {
                    $('#sub_sub_category').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));
                });
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
        document.getElementById("product_name").addEventListener("input", function () {
            let theSlug = string_to_slug(this.value);
            document.getElementById("slug").value = theSlug;
        });
        function string_to_slug(str) {
            str = str.replace(/^\s+|\s+$/g, ""); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to = "aaaaeeeeiiiioooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
            }

            str = str
                .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
                .replace(/\s+/g, "-") // collapse whitespace and replace by -
                .replace(/-+/g, "-"); // collapse dashes
            str = str+`-`+makeid(10);
            return str;
        }
        function makeid(length) {
          var result           = '';
          var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          var charactersLength = characters.length;
          for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
          return result;
        }
    </script>
@endsection

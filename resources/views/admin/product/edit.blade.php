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
               Edit Master Product
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="main-card mb-3 card">
      <div class="card-body">
         <form action="{{ route('admin.master-product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="merchant_id">Merchant</label>
                        <select name="merchant_id" id="merchant_id" class="js-data-example-ajax multiselect-dropdown form-control"
                                onchange="handleMerchant(this.value)" required title="Select Merchant">
                            <option disabled selected value="">Choose One!</option>
                            @foreach ($merchants as $merchant)
                                <option {{ $product->merchant_id == $merchant->id ? 'selected':'' }} value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" name="product_name" value="{{ $product->name }}" class="form-control">
                        @error('product_name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ $product->slug }}" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="price">Price</label>
                        <input type="number" name="price" id="price" value="{{ substr($product->price, 0, -3) }}" class="form-control">
                        @error('price')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="discount_type">Discount Type</label>
                        <select class="multiselect-dropdown form-control" name="discount_type" id="discount_type">
                            <option selected value=""></option>
                            <option {{ $product->discount_type == 'percent' ? 'selected':'' }} value="percent">Percent</option>
                            <option {{ $product->discount_type == 'amount' ? 'selected':'' }} value="amount">Amount</option>
                        </select>
                        @error('discount_type')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="discount">Discount</label>
                       <input type="number" name="discount" id="discount" value="{{ $product->discount == 0 ? '' : substr($product->discount, 0, -3) }}" class="form-control">
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
                        <select class="multiselect-dropdown form-control" name="sub_category" id="sub_category" onchange="handleSubCategory(this.value)" required>
                            <option value=""></option>
                            @foreach ($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                       <label for="sub_sub_category">Sub Sub Category</label>
                        <select class="multiselect-dropdown form-control" name="sub_sub_category" id="sub_sub_category">
                            {{-- @foreach ($sub_sub_categories as $sub_sub_category)
                                <option {{ $sub_sub_category_id == $sub_sub_category->id ?'selected':'' }} value="{{ $sub_sub_category->id }}">{{ $sub_sub_category->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="available_time_starts">Available time starts</label>
                        <input type="time" name="available_time_starts" class="form-control" id="available_time_starts" value="{{ $product->available_time_starts }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="available_time_ends">Available time ends</label>
                        <input type="time" name="available_time_ends" class="form-control" id="available_time_ends" value="{{ $product->available_time_ends }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Favorite</label><br>
                        <label class="m-auto align-middle" for="favorite">
                           <input type="checkbox" data-toggle="toggle" data-size="normal" name="favorite" id="favorite" {{ $product->favorite == 1 ? 'checked':'' }}>
                       </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea type="text" name="short_description" class="form-control">{{ $product->short_description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control">{!! $product->description !!}</textarea>
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
               <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" src="{{ URL::to($product->compressImage('w_100,h_100')) }}" alt=""/>
            </div>
            <div class="text-right mt-2">
               <a href="{{ route('admin.master-product') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
               <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
            </div>
         </form>
      </div>
   </div>
@endsection
@section('js')
    <script>
        function handleMerchant(id){
             $.get('/admin/get-merchants/'+id,function(response){
                $('#category').val(response.category);
                $('#category_name').val(response.category_name);
                $("#sub_category").empty();
                $('#available_time_starts').val('');
                $('#available_time_ends').val('');
                $('#available_time_starts').val(response.open_time);
                $('#available_time_ends').val(response.closing_time);
                $.each(response.sub_categories, function (i, item) {
                    $('#sub_category').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));
                });
                let sub_category_id = $('#sub_category').val();
                $.get('/admin/get-sub-sub-category/'+sub_category_id,function(response){
                    $('#sub_sub_category').empty();
                    $.each(response, function (i, item) {
                        $('#sub_sub_category').append($('<option>', {
                            value: item.id,
                            text : item.name
                        }));
                    });
                });
            });
        };
        function handleSubCategory(id){
            $('#sub_sub_category').empty();
            $.get(`/admin/get-sub-sub-category/${id}`,function(response){
                $.each(response, function (i, item) {
                    $('#sub_sub_category').append($("<option>", {
                        value: item.id,
                        text : item.name
                    }));
                });
            });
        }
        $(document).ready(function(){
            $.get('/admin/get-merchants/{{ $product->merchant_id }}',function(response){
                $('#category').val(response.category);
                $('#category_name').val(response.category_name);
            });

            $.get('/admin/get-sub-category/{{ $category_id }}',function(response){
              if(response){
                $('#sub_category').empty();
                $.each(response, function (i, item) {
                  $('#sub_category').append($("<option>", {
                      value: item.id,
                      text : item.name
                  }));
                });
                $('#sub_category').val('{{ $sub_category_id }}');
                $('#sub_category').trigger('change');
              }
            });


            $.get('/admin/get-sub-sub-category/{{ $sub_category_id }}',function(response){
              if(response){
                $('#sub_sub_category').empty();
                $.each(response, function (i, item) {
                    $('#sub_sub_category').append($("<option>", {
                        value: item.id,
                        text : item.name
                    }));
                });
                $('#sub_sub_category').val('{{ $sub_sub_category_id }}');
                $('#sub_sub_category').trigger('change');
              }
            });
            $('#sub_category').val('{{ $sub_sub_category_id }}').trigger('change');
        });

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
            let slug = $("#slug").val();
            if (slug === '') {
              document.getElementById("slug").value = theSlug;
            }

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
        CKEDITOR.replace('description', {
          height: 250,
          removeButtons: 'PasteFromWord'
        });
    </script>
@endsection

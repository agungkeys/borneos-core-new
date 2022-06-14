@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="metismenu-icon pe-7s-home icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Add Master Merchant
               <div class="page-title-subheading">
               </div>
            </div>
         </div>
      </div>
   </div>

    <form action="{{ route('admin.master-merchant.store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header">Merchant Info</div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="main_category_id">Merchant Category</label>
                            <select name="main_category_id" id="main_category_id" class="form-control">
                                <option hidden>Select Merchant Category</option>
                                @foreach ($main_categories as $main_category)
                                    <option value="{{ $main_category['id'] }}">{{ $main_category['name'] }}</option>
                                @endforeach
                            </select>
                            @error('main_category_id')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="categories_id">Merchant Sub Category</label>
                            <select name="categories_id" id="categories_id" multiple="multiple" class="multiselect-dropdown form-control">
                            </select>
                            @error('categories_id')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Merchant Name</label>
                            <input type="text" id="name" name="name" class="form-control">
                            @error('name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Merchant Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control">
                            @error('slug')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district">Merchant District</label>
                            <input type="text" id="district" name="district" class="form-control">
                            @error('district')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Merchant Address</label>
                            <input type="text" id="address-input" name="address" class="form-control map-input" placeholder="">
                            <input type="hidden" name="latitude" id="address-latitude" value="0" />
                            <input type="hidden" name="longitude" id="address-longitude" value="0" />
                            @error('address')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                            <div style="width: 100%; height: 400px" id="address-map"></div>
                        </div>
                        <div class="form-group">
                            <label for="tax">VAT/TAX (%)</label>
                            <input type="number" id="tax" name="tax" class="form-control" min="0" step=".01">
                            @error('tax')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">Merchant Logo</label><small style="color: red"> ( Ratio 1:1 )</small><br>
                            <input type="file" id="customFileEg1" name="logo">
                            <div class="form-group text-center" style="margin-bottom:0%;">
                                <img style="height: 200px;border: 1px solid; border-radius: 10px;" id="viewer" src="" alt="">
                            </div>
                            @error('logo')
                                <br><span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cover_photo">Cover Photo</label><small style="color: red"> ( Ratio 2:1 )</small><br>
                            <input type="file" id="coverImageUpload" name="cover_photo">
                            <div class="form-group text-center" style="margin-bottom:0%;">
                                <img style="height: 200px;border: 1px solid; border-radius: 10px;" id="coverImageViewer" src="" alt="">
                            </div>
                            @error('cover_photo')
                                <br><span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="seo_image">SEO Image</label><br>
                            <input type="file" id="seoImageUpload" name="seo_image">
                            <div class="form-group text-center" style="margin-bottom:0%;">
                                <img style="height: 200px;border: 1px solid; border-radius: 10px;" id="seoImageViewer" src="" alt="">
                            </div>
                            @error('seo_image')
                                <br><span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header">Owner Info</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="f_name">First Name</label>
                            <input type="text" id="f_name" name="f_name" class="form-control" >
                            @error('f_name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="l_name">Last Name</label>
                            <input type="text" id="l_name" name="l_name" class="form-control">
                            @error('l_name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" min="0" id="phone" name="phone" class="form-control" >
                            @error('phone')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" >
                            @error('email')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" id="password" name="password" class="form-control" >
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            @error('password')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <div class="input-group" id="show_hide_password_confirm">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" >
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            @error('confirmPassword')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-right mt-2">
                            <a href="{{ route('admin.master-merchant') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                            <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+viewer).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);

            }
        }
        $("#customFileEg1").change(function () {
            readURL(this, 'viewer');
        });
        $("#coverImageUpload").change(function () {
            readURL(this, 'coverImageViewer');
        });
         $("#seoImageUpload").change(function () {
            readURL(this, 'seoImageViewer');
        });
        $(document).ready(function() {
            //toggle password hide
            $("#show_hide_password button").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
            //toggle confirm password hide
            $("#show_hide_password_confirm button").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password_confirm input').attr("type") == "text"){
                    $('#show_hide_password_confirm input').attr('type', 'password');
                    $('#show_hide_password_confirm i').addClass( "fa-eye-slash" );
                    $('#show_hide_password_confirm i').removeClass( "fa-eye" );
                }else if($('#show_hide_password_confirm input').attr("type") == "password"){
                    $('#show_hide_password_confirm input').attr('type', 'text');
                    $('#show_hide_password_confirm i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password_confirm i').addClass( "fa-eye" );
                }
            });
        });

        $('#main_category_id').change(function(){
        var stateId = $(this).val();
        if(stateId){
            $.ajax({
            type:"GET",
            url:"/admin/get-sub-category/"+stateId,
            dataType: 'JSON',
            success:function(res){
                if(res){
                    $.each(res,function(key,data){
                        $("#categories_id").append('<option value="'+key+'">'+data.name+'</option>');
                    });
                }else{
                $("#categories_id").empty();
                }
            }
            });
        }else{
            $("#categories_id").empty();
        }
        });
    </script>
@endsection

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
                            <select name="categories_id[]" id="categories_id" multiple="multiple" class="multiselect-dropdown form-control">
                            </select>
                            @error('categories_id')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Merchant Name</label>
                            <input type="text" id="name" name="name" class="form-control" autocomplete="none">
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
                            <textarea name="address" class="form-control"></textarea>
                            @error('address')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="coordinate">Coordinate Point</label>
                            <div class="input-group">
                                <input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude" readonly>
                                <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="btnCoordinate" class="btn btn-success" data-toggle="modal" data-target="#addCoordinate">Add Coordinate</button>
                                </div>
                            </div>
                            @error('latitude')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                            @error('longitude')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tax">VAT/TAX (%)</label>
                            <input type="number" id="tax" name="tax" class="form-control" min="0" step=".01" value="0">
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
                            <label for="seo_image">SEO Image</label><small style="color: red"> ( Ratio 1:1 )</small><br>
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
                                <input type="password" onkeyup="checkMatching()" id="password" name="password" class="form-control" >
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
                                <input type="password" onkeyup="checkMatching()" id="confirmPassword" name="confirmPassword" class="form-control" >
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            <span class="text-danger mt-2" id="messageMatching"></span>
                            @error('confirmPassword')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-right mt-2">
                            <a href="{{ route('admin.master-merchant') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                            <button type="submit" id="buttonSubmit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                <input type="text" id="address-input" name="address" class="form-control map-input" onchange="hideMaps()" autocomplete="off" placeholder="Your Address">
                <input type="hidden" name="latitude" id="address-latitude"/>
                <input type="hidden" name="longitude" id="address-longitude"/><br>
                <div style="width: 100%; height: 400px; display: none;" id="address-map"></div>
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

        function checkMatching() {
            if (document.getElementById('password').value === document.getElementById('confirmPassword').value) {
                document.getElementById('messageMatching').innerHTML = '';
                document.getElementById('buttonSubmit').disabled = false;
            } else {
                document.getElementById('messageMatching').innerHTML = 'Password does not match';
                document.getElementById('buttonSubmit').disabled = true;
            }
        }

        $('#main_category_id').change(function(){
        var stateId = $(this).val();
        if(stateId){
            $.ajax({
            type:"GET",
            url:"/admin/get-sub-category/"+stateId,
            dataType: 'JSON',
            success:function(res){
                if(res){
                    $("#categories_id").empty();
                    $.each(res,function(key,data){
                        $("#categories_id").append('<option value="'+data.id+'">'+data.name+'</option>');
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

        $(document).ready(function() {
            deleteCoordinate();
        });

        function hideMaps(){
            document.getElementById('address-map').style.display =""
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
        }
        else{
            document.getElementById('btnCoordinate').innerHTML= "Add Coordinate"
        }

        //autoSlug
        document.getElementById("name").addEventListener("input", function () {
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

        return str;
        }

    </script>
@endsection

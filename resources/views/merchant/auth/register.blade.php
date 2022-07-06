@extends('layouts.app-merchant-auth')

@section('content')
<div class="app-container app-theme-white body-tabs-shadow">
  <div class="app-container">
    <div class="h-100">
      <div class="h-100 no-gutters row">
        <div class="d-none d-lg-block col-lg-4">
          <div class="slider-light">
            <div class="slick-slider">
              <div>
                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                  <div class="slide-img-bg" style="background-image: url('{{ asset(env('PUBLIC_ASSETS').'images/originals/city.jpg') }}');"></div>
                  <div class="slider-content">
                    <h3>Semangat 100jt Pertama!</h3>
                    <p>ArchitectUI is like a dream. Some think it's too good to be true! Extensive collection of unified React Boostrap Components and Elements. </p>
                  </div>
                </div>
              </div>
              <div>
                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                  <div class="slide-img-bg" style="background-image: url('{{ asset(env('PUBLIC_ASSETS').'images/originals/citynights.jpg') }}');"></div>
                  <div class="slider-content">
                    <h3>Scalable, Modular, Consistent</h3>
                    <p>Easily exclude the components you don't require. Lightweight, consistent Bootstrap based styles across all elements and components </p>
                  </div>
                </div>
              </div>
              <div>
                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                  <div class="slide-img-bg" style="background-image: url('{{ asset(env('PUBLIC_ASSETS').'images/originals/citydark.jpg') }}');"></div>
                  <div class="slider-content">
                    <h3>Complex, but lightweight</h3>
                    <p>We've included a lot of components that cover almost all use cases for any type of application.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
            <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9" style="min-width: 100%">
                <form action="{{ route('merchant.auth.register.submit') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="main_category_id">Kategori Merchant</label>
                                        <select name="main_category_id" id="main_category_id" class="form-control" required>
                                            <option hidden disabled value="" selected>Pilih Kategori Merchant</option>
                                            @foreach ($main_categories as $main_category)
                                                <option value="{{ $main_category['id'] }}">{{ $main_category['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('main_category_id')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group" style="align-content: center">
                                        <label for="categories_id">Sub Kategori Merchant</label>
                                        <select name="categories_id[]" id="categories_id" multiple="multiple" class="multiselect-dropdown form-control" required>
                                            <option hidden disabled value="" selected>Pilih Kategori Merchant</option>
                                        </select>
                                        @error('categories_id')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama & Slug Merchant</label>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" class="form-control" autocomplete="none" placeholder="Nama Merchant" required>
                                            <input type="text" id="slug" name="slug" class="form-control" placeholder="Slug Merchant" required>
                                        </div>
                                        @error('name')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                        @error('slug')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat & Kelurahan Merchant</label>
                                        <div class="input-group">
                                            <textarea name="address" class="form-control" rows="1"></textarea>
                                            <select name="district" id="district" class="js-data-example-ajax multiselect-dropdown form-control" required title="Select District" required>
                                                <option hidden selected value="">Pilih Kelurahan</option>
                                                <option value="Api - Api">Api - Api</option>
                                                <option value="Belimbing">Belimbing</option>
                                                <option value="Berbas Pantai">Berbas Pantai</option>
                                                <option value="Berbas Tengah">Berbas Tengah</option>
                                                <option value="Bontang Baru">Bontang Baru</option>
                                                <option value="Bontang Kuala">Bontang Kuala</option>
                                                <option value="Bontang Lestari">Bontang Lestari</option>
                                                <option value="Guntung">Guntung</option>
                                                <option value="Gunung Elai">Gunung Elai</option>
                                                <option value="Kanaan">Kanaan</option>
                                                <option value="Loktuan">Loktuan</option>
                                                <option value="Satimpo">Satimpo</option>
                                                <option value="Tanjung Laut">Tanjung Laut</option>
                                                <option value="Tanjung Laut Indah">Tanjung Laut Indah</option>
                                                <option value="Telihan">Telihan</option>
                                            </select>
                                        </div>
                                        @error('address')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                        @error('district')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coordinate">Titik Koordinat</label>
                                        <div class="input-group">
                                            <input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude" readonly required>
                                            <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" readonly required>
                                            <div class="input-group-append">
                                                <button type="button" id="btnCoordinateRegister" class="btn btn-success" data-toggle="modal" data-target="#addCoordinate">Tambah Koordinat</button>
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
                                        <label for="logo">Logo Merchant</label><small style="color: red"> ( Ratio 1:1 )</small><br>
                                        <input type="file" id="customFileEg1" name="logo" required>
                                        <div class="form-group text-center" style="margin-bottom:0%;">
                                            <img style="height: 100px;border-radius: 10px;min-height:100px" id="viewer" src="" alt="">
                                        </div>
                                        @error('logo')
                                            <br><span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="f_name">Nama Lengkap</label>
                                        <div class="input-group">
                                            <input type="text" id="f_name" name="f_name" class="form-control" placeholder="Nama Depan" required>
                                            <input type="text" id="l_name" name="l_name" class="form-control" placeholder="Nama Belakang" required>
                                        </div>
                                        @error('f_name')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">No. Handphone</label>
                                        <input type="number" min="0" id="phone" name="phone" class="form-control" placeholder="08xxxxxxxxxx" required>
                                        @error('phone')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                                        @error('email')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Kata Sandi & Konfirmasi Kata Sandi</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" onkeyup="checkMatching()" id="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                                            <input type="password" onkeyup="checkMatching()" id="confirmPassword" name="confirmPassword" class="form-control"  placeholder="" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                        <span class="text-danger mt-2" id="messageMatching"></span>
                                        @error('password')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-right mt-2">
                                        <a href="{{ route('merchant.auth.login') }}" onclick="loading()" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Kembali</a>
                                        <button type="submit" id="buttonSubmit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addCoordinate" tabindex="-1" role="dialog" aria-labelledby="addCoordinate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCoordinate">Tambah Koordinat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="address-input" name="address" class="form-control map-input" onchange="hideMaps()" autocomplete="off" placeholder="Masukkan alamat anda">
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
        $(document).ajaxStart($.blockUI({message: $('.body-block-loading')})).ajaxStop($.unblockUI);
        if(stateId){
            $.ajax({
                type:"GET",
                url:"/merchant/auth/get-sub-category/"+stateId,
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
            deleteCoordinateRegister();
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
            document.getElementById('btnCoordinateRegister').innerHTML= "Ubah Koordinat"
        }
        else{
            document.getElementById('btnCoordinateRegister').innerHTML= "Tambah Koordinat"
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

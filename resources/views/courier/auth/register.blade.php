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
                <form action="{{ route('courier.auth.register.submit') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">No. Handphone</label>
                                        <input type="number" class="form-control" name="phone" id="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="coordinate">Titik Koordinat</label>
                                        <div class="input-group">
                                            <input type="text" id="latitude" name="address_lat" class="form-control" placeholder="Latitude" readonly required>
                                            <input type="text" id="longitude" name="address_lang" class="form-control" placeholder="Longitude" readonly required>
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
                                    {{-- <div class="form-group">
                                        <label for="address_lat">Address latitude & longitude</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="address_lat" id="address_lat">
                                            <input type="text" class="form-control" name="address_lang" id="address_lang">
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        {{-- <div class="input-group"> --}}
                                            <input type="email" class="form-control" name="email" id="email" required>
                                            {{-- <input type="password" class="form-control" style="max-width: 35%" name="password" id="password" required> --}}
                                        {{-- </div> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Kata Sandi & Konfirmasi Kata Sandi</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" onkeyup="checkMatching()" id="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                                            <input type="password" onkeyup="checkMatching()" id="confirmPassword" name="confirmPassword" class="form-control"  placeholder="Konfirmasi Kata Sandi" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                        <span class="text-danger mt-2" id="messageMatching"></span>
                                        @error('password')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- <div class="text-center my-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img id="imgPreviewIdentity" style="height: 130px;min-height:130px;max-width:100%;" alt=""/>
                                            </div>
                                            <div class="col-md-6">
                                                <img id="imgPreviewProfile" style="height: 130px;min-height:130px;max-width:100%;" alt=""/>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="identity_type">Tipe & Nomor Identitas</label>
                                        <div class="input-group">
                                            <select name="identity_type" id="identity_type" class="form-control" required>
                                                <option value="ktp">KTP</option>
                                                <option value="sim">SIM</option>
                                                <option value="kk">KK</option>
                                                <option value="default">Default</option>
                                            </select>
                                            <input type="text" class="form-control" name="identity_no" id="identity_no" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="identity_expired">Masa Aktif Identitas</label>
                                        <input type="date" class="form-control" name="identity_expired" id="identity_expired">
                                    </div>

                                    <label for="identity_image">Gambar Indentitas</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Unggah Gambar</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="previewImageOnIdentity()"" class="custom-file-input" id="identity_image" name="identity_image" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Pilih File</label>
                                        </div>
                                    </div>

                                    <label for="profile_image">Gambar Profil</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon03">Unggah Gambar</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="previewImageOnProfile()"" class="custom-file-input" id="profile_image" name="profile_image" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile03">Pilih File</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="badge">Badge</label>
                                        <select name="badge" id="badge" class="form-control" required>
                                            <option value="new">New</option>
                                            <option value="level_1">Level 1</option>
                                            <option value="level_2">Level 2</option>
                                            <option value="level_3">Level 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="join_date">Tanggal Bergabung</label>
                                        <input type="date" class="form-control" name="join_date" id="join_date" required>
                                    </div>
                                    <div class="text-right mt-2">
                                        <a href="{{ route('courier.auth.login') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Kembali</a>
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
                <button type="button" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg" data-dismiss="modal" onclick="setCoordinate()"><i class="pe-7s-diskette btn-icon-wrapper"></i>Simpan Koordinat</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#identity_image').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    })
    $('#profile_image').on('change',function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
    })
    function previewImageOnIdentity() {
        imgPreviewIdentity.src=URL.createObjectURL(event.target.files[0])
    }
    function previewImageOnProfile() {
        imgPreviewProfile.src=URL.createObjectURL(event.target.files[0])
    }

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
</script>
@endsection

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
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate"
                                        tabindex="-1">
                                        <div class="slide-img-bg"
                                            style="background-image: url('{{ asset(env('PUBLIC_ASSETS') . 'images/originals/slide01.jpg') }}');">
                                        </div>
                                        <div class="slider-content">
                                            <h3>Semangat 100jt Pertama!</h3>
                                            <p>ArchitectUI is like a dream. Some think it's too good to be true! Extensive
                                                collection of unified React Boostrap Components and Elements. </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark"
                                        tabindex="-1">
                                        <div class="slide-img-bg"
                                            style="background-image: url('{{ asset(env('PUBLIC_ASSETS') . 'images/originals/slide02.jpg') }}');">
                                        </div>
                                        <div class="slider-content">
                                            <h3>Scalable, Modular, Consistent</h3>
                                            <p>Easily exclude the components you don't require. Lightweight, consistent
                                                Bootstrap based styles across all elements and components </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning"
                                        tabindex="-1">
                                        <div class="slide-img-bg"
                                            style="background-image: url('{{ asset(env('PUBLIC_ASSETS') . 'images/originals/slide03.jpg') }}');">
                                        </div>
                                        <div class="slider-content">
                                            <h3>Complex, but lightweight</h3>
                                            <p>We've included a lot of components that cover almost all use cases for any
                                                type of application.</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning"
                                        tabindex="-1">
                                        <div class="slide-img-bg"
                                            style="background-image: url('{{ asset(env('PUBLIC_ASSETS') . 'images/originals/slide04.jpg') }}');">
                                        </div>
                                        <div class="slider-content">
                                            <h3>borneos.co</h3>
                                            <p>We've included a lot of components that cover almost all use cases for any
                                                type of application.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8"> --}}
                    <div class="d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8 add-merchant">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9" style="min-width: 100%">
                            <div class="d-flex mb-3" style="padding-top: 3%">
                                <img src="{{ env('PUBLIC_IMAGE') }}/images/logo.svg" />
                                <div class="ml-2">
                                    <h5 class="mb-0 t-bold">Borneos</h5>
                                    <h5 class="mb-0">Merchant</h5>
                                    <h5 class="mb-0">Management</h5>
                                </div>
                            </div>
                            <h5>
                                <b> Pendaftaran Mitra Borneos </b>
                            </h5><br>
                            <form id="form" action="{{ route('merchant.auth.register.submit') }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="main-card mb-3 card">
                                            <div class="card-header" style="height: 2.5rem">Informasi Merchant</div>
                                            <div class="card-body" style="padding-bottom: 0px;padding-top:3px">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="main_category_id">Kategori Merchant</label>
                                                    <select name="main_category_id" id="main_category_id"
                                                        class="form-control" required>
                                                        <option hidden disabled value="" selected>Pilih Kategori
                                                            Merchant</option>
                                                        @foreach ($main_categories as $main_category)
                                                            <option value="{{ $main_category['id'] }}"
                                                                {{ $main_category['id'] == old('main_category_id') ? 'selected' : '' }}>
                                                                {{ $main_category['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('main_category_id')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group" style="align-content: center">
                                                    <label for="categories_id">Sub Kategori Merchant</label>
                                                    <select name="categories_id[]" id="categories_id" multiple="multiple"
                                                        class="multiselect-dropdown form-control" required>
                                                        <option hidden disabled value="" selected>Pilih Kategori
                                                            Merchant</option>
                                                    </select>
                                                    @error('categories_id')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Nama & Slug Merchant</label>
                                                    <div class="input-group">
                                                        <input type="text" id="name" name="name"
                                                            value="{{ old('name') }}" class="form-control"
                                                            autocomplete="none" placeholder="Nama Merchant" required>
                                                        <input type="text" id="slug" name="slug"
                                                            value="{{ old('slug') }}" class="form-control"
                                                            placeholder="Slug Merchant" required readonly>
                                                    </div>
                                                    @error('name')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                    @error('slug')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Alamat Merchant</label>
                                                    <textarea name="address" class="form-control" rows="1" required>{{ old('address') }}</textarea>
                                                    @error('address')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="district">Kelurahan Merchant</label>
                                                    <select name="district" id="district"
                                                        class="js-data-example-ajax multiselect-dropdown form-control col-12"
                                                        required title="Select District" required>
                                                        <option hidden selected value="">Pilih Kelurahan</option>
                                                        <option value="Api - Api"
                                                            {{ old('district') == 'Api - Api' ? 'selected' : '' }}>Api -
                                                            Api</option>
                                                        <option value="Belimbing"
                                                            {{ old('district') == 'Belimbing' ? 'selected' : '' }}>
                                                            Belimbing</option>
                                                        <option value="Berbas Pantai"
                                                            {{ old('district') == 'Berbas Pantai' ? 'selected' : '' }}>
                                                            Berbas Pantai</option>
                                                        <option value="Berbas Tengah"
                                                            {{ old('district') == 'Berbas Tengah' ? 'selected' : '' }}>
                                                            Berbas Tengah</option>
                                                        <option value="Bontang Baru"
                                                            {{ old('district') == 'Bontang Baru' ? 'selected' : '' }}>
                                                            Bontang Baru</option>
                                                        <option value="Bontang Kuala"
                                                            {{ old('district') == 'Bontang Kuala' ? 'selected' : '' }}>
                                                            Bontang Kuala</option>
                                                        <option value="Bontang Lestari"
                                                            {{ old('district') == 'Bontang Lestari' ? 'selected' : '' }}>
                                                            Bontang Lestari</option>
                                                        <option value="Guntung"
                                                            {{ old('district') == 'Guntung' ? 'selected' : '' }}>Guntung
                                                        </option>
                                                        <option value="Gunung Elai"
                                                            {{ old('district') == 'Gunung Elai' ? 'selected' : '' }}>Gunung
                                                            Elai</option>
                                                        <option value="Kanaan"
                                                            {{ old('district') == 'Kanaan' ? 'selected' : '' }}>Kanaan
                                                        </option>
                                                        <option value="Loktuan"
                                                            {{ old('district') == 'Loktuan' ? 'selected' : '' }}>Loktuan
                                                        </option>
                                                        <option value="Satimpo"
                                                            {{ old('district') == 'Satimpo' ? 'selected' : '' }}>Satimpo
                                                        </option>
                                                        <option value="Tanjung Laut"
                                                            {{ old('district') == 'Tanjung Laut' ? 'selected' : '' }}>
                                                            Tanjung Laut</option>
                                                        <option
                                                            value="Tanjung Laut Indah"{{ old('district') == 'Tanjung Laut Indah' ? 'selected' : '' }}>
                                                            Tanjung Laut Indah</option>
                                                        <option value="Telihan"
                                                            {{ old('district') == 'Telihan' ? 'selected' : '' }}>Telihan
                                                        </option>
                                                    </select>
                                                    @error('district')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="coordinate">Titik Koordinat</label>
                                                    <div class="input-group">
                                                        <input type="text" id="latitude" name="latitude"
                                                            class="form-control" placeholder="Latitude" readonly required>
                                                        <input type="text" id="longitude" name="longitude"
                                                            class="form-control" placeholder="Longitude" readonly
                                                            required>
                                                        <div class="input-group-append">
                                                            <button type="button" id="btnCoordinateRegister"
                                                                class="btn btn-success" data-toggle="modal"
                                                                data-target="#addCoordinate">Tambah Koordinat</button>
                                                        </div>
                                                    </div>
                                                    @error('latitude')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                    @error('longitude')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group ">
                                                    <label for="logo">Logo Merchant</label><small style="color: red">
                                                        ( Ratio 1:1 )</small><br>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroupFileAddon02">Unggah Gambar</span>
                                                            <img id="imgPreviewLogo"
                                                                style="max-height:38px;min-width:126.5px;max-width:126.5px;border:1px solid #ced4da"
                                                                hidden alt="" />
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*"
                                                                onchange="previewImageOnLogo()" class="custom-file-input"
                                                                id="customFileEg1" name="logo"
                                                                aria-describedby="inputGroupFileAddon02">
                                                            <label class="custom-file-label" for="inputGroupFile02">Pilih
                                                                File</label>
                                                        </div>
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
                                            <div class="card-header" style="height: 2.5rem">Informasi Pemilik</div>
                                            <div class="card-body" style="padding-bottom: 0px;padding-top:3px">
                                                <div class="form-group">
                                                    <label for="f_name">Nama Lengkap</label>
                                                    <div class="input-group">
                                                        <input type="text" id="f_name" name="f_name"
                                                            value="{{ old('f_name') }}" class="form-control"
                                                            placeholder="Nama Depan" required>
                                                        <input type="text" id="l_name" name="l_name"
                                                            value="{{ old('l_name') }}" class="form-control"
                                                            placeholder="Nama Belakang" required>
                                                    </div>
                                                    @error('f_name')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">No. Handphone</label>
                                                    <input type="number" min="0" id="phone" name="phone"
                                                        class="form-control" value="{{ old('phone') }}"
                                                        placeholder="08xxxxxxxxxx" required>
                                                    @error('phone')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email"
                                                        name="email"value="{{ old('email') }}" class="form-control"
                                                        placeholder="Email" required>
                                                    @error('email')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Kata Sandi & Konfirmasi Kata Sandi</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" onkeyup="checkMatching()"
                                                            value="{{ old('password') }}" id="password" name="password"
                                                            class="form-control" placeholder="Kata Sandi" required>
                                                        <input type="password" onkeyup="checkMatching()"
                                                            value="{{ old('confirmPassword') }}" id="confirmPassword"
                                                            name="confirmPassword" class="form-control" placeholder=""
                                                            required>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-light"><i
                                                                    class="fa fa-eye-slash"></i></button>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger mt-2" id="messageMatching"></span>
                                                    @error('password')
                                                        <span class="text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="text-right mt-2">
                                                    <a
                                                        href="{{ route('merchant.auth.login') }}"class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i
                                                            class="pe-7s-back btn-icon-wrapper"></i>Kembali</a>
                                                    <button type="submit" id="buttonSubmit"
                                                        class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i
                                                            class="pe-7s-diskette btn-icon-wrapper"></i>Daftar
                                                        Sekarang</button>
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

    <div class="modal fade" id="addCoordinate" tabindex="-1" role="dialog" aria-labelledby="addCoordinate"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCoordinate">Tambah Koordinat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="address-input" name="address" class="form-control map-input"
                        onchange="hideMaps()" autocomplete="off" placeholder="Masukkan alamat anda">
                    <input type="hidden" name="latitude" id="address-latitude" />
                    <input type="hidden" name="longitude" id="address-longitude" /><br>
                    <div style="width: 100%; height: 400px; display: none;" id="address-map"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg" data-dismiss="modal"
                        onclick="setCoordinate()"><i class="pe-7s-diskette btn-icon-wrapper"></i>Simpan
                        Coordinate</button>
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

                reader.onload = function(e) {
                    $('#' + viewer).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#customFileEg1").change(function() {
            readURL(this, 'viewer');
        });

        $(document).ready(function() {
            //toggle password hide
            $("#show_hide_password button").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
            //toggle confirm password hide
            $("#show_hide_password_confirm button").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_confirm input').attr("type") == "text") {
                    $('#show_hide_password_confirm input').attr('type', 'password');
                    $('#show_hide_password_confirm i').addClass("fa-eye-slash");
                    $('#show_hide_password_confirm i').removeClass("fa-eye");
                } else if ($('#show_hide_password_confirm input').attr("type") == "password") {
                    $('#show_hide_password_confirm input').attr('type', 'text');
                    $('#show_hide_password_confirm i').removeClass("fa-eye-slash");
                    $('#show_hide_password_confirm i').addClass("fa-eye");
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

        $('#main_category_id').change(function() {
            var stateId = $(this).val();
            $(document).ajaxStart($.blockUI({
                message: $('.body-block-loading')
            })).ajaxStop($.unblockUI);
            if (stateId) {
                $.ajax({
                    type: "GET",
                    url: "/merchant/auth/get-sub-category/" + stateId,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#categories_id").empty();
                            $.each(res, function(key, data) {
                                $("#categories_id").append('<option value="' + data.id + '">' +
                                    data.name + '</option>');
                            });
                        } else {
                            $("#categories_id").empty();
                        }
                    }
                });
            } else {
                $("#categories_id").empty();
            }
        });

        $(document).ready(function() {
            deleteCoordinateRegister();
        });

        function hideMaps() {
            document.getElementById('address-map').style.display = ""
        }

        function getCookie(cname) {
            let name = cname + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
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
        if (lat != "") {
            document.getElementById('btnCoordinateRegister').innerHTML = "Ubah Koordinat"
        } else {
            document.getElementById('btnCoordinateRegister').innerHTML = "Tambah Koordinat"
        }

        //autoSlug
        document.getElementById("name").addEventListener("input", function() {
            function makeid(length) {
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() *
                        charactersLength));
                }
                return result;
            }
            let theSlug = string_to_slug(this.value);
            document.getElementById("slug").value = theSlug + "-" + makeid(10);
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

        $('#customFileEg1').on('change', function(e) {
            var fileName = e.target.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
            document.getElementById('inputGroupFileAddon02').style.display = 'none';
            imgPreviewLogo.removeAttribute("hidden");
        })

        function previewImageOnLogo() {
            imgPreviewLogo.src = URL.createObjectURL(event.target.files[0])
        }

        //submit key enter
        document.getElementById('form').onkeyup = function(e) {
            if (e.keyCode === 13) {
                document.getElementById('buttonSubmit').click();
            }
            return true;
        }
    </script>
@endsection

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
                Edit Master Merchant
                <div class="page-title-subheading">

                </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('merchant.master-merchant.update',$master_merchant) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Informasi Merchant
                        <div class="btn-actions-pane-right text-capitalize">
                            <label class="m-auto align-middle" for="statusCheckbox{{$master_merchant->id}}">
                                <input type="checkbox" data-toggle="toggle" data-size="small" data-on="Buka" data-off="Tutup" onChange="location.href='{{route('merchant.master-merchant.status',[$master_merchant['id'],$master_merchant->active?0:1])}}'" id="statusCheckbox{{$master_merchant->id}}" {{$master_merchant->active?'checked':''}} >
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="main_category_id">Kategori Merchant</label>
                            <select name="main_category_id" id="main_category_id" class="form-control">
                                <option hidden>Pilih Kategori Merchant</option>
                                @foreach($categories_position_0 as $category_position_0)
                                    <option {{ $master_merchant->category_id == $category_position_0->parent_id ? 'selected':'' }} value="{{$category_position_0->parent_id}}">{{$category_position_0->name}}</option>
                                @endforeach
                            </select>
                            @error('main_category_id')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="categories_id">Sub Kategori Merchant</label>
                            <select name="categories_id[]" id="categories_id" multiple="multiple" class="multiselect-dropdown form-control">
                                @foreach ($categories_position_1 as $category_position_1)
                                    @php
                                        $categories_ids = explode(',',$master_merchant->categories_id)
                                    @endphp
                                    <option value="{{ $category_position_1->id }}" {{is_array($categories_ids) && in_array($category_position_1->id, $categories_ids) ? 'selected' : '' }}> {{$category_position_1->name}}</option>
                                @endforeach
                            </select>
                            @error('categories_id')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Merchant</label>
                            <div class="input-group">
                                <input type="text" id="name" name="name" value="{{ $master_merchant->name }}" class="form-control" required>
                            </div>
                            @error('name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug Merchant</label>
                                <input type="text" id="slug" name="slug" value="{{ $master_merchant->slug }}" class="form-control" readonly>
                            @error('slug')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district">Kelurahan Merchant</label>
                            <input type="text" id="district" name="district" value="{{ $master_merchant->district }}" class="form-control">
                            @error('district')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamant Merchant</label>
                            <textarea name="address" class="form-control">{{ $master_merchant->address }}</textarea>
                            @error('address')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="coordinate">Titik Koordinat</label>
                            <div class="input-group">
                                <input type="text" id="latitude" name="latitude" value="{{ $master_merchant->latitude }}" class="form-control" placeholder="Latitude" readonly>
                                <input type="text" id="longitude" name="longitude" value="{{ $master_merchant->longitude }}" class="form-control" placeholder="Longitude" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="btnCoordinate" class="btn btn-success" data-toggle="modal" data-target="#addCoordinate">Ubah Koordinat</button>
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
                            <input type="number" id="tax" name="tax" class="form-control" min="0" step=".01" value="{{ $master_merchant->tax }}">
                            @error('tax')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo Merchant</label><small style="color: red"> ( Ratio 1:1 )</small><br>
                            <input type="file" id="customFileEg1" name="logo">
                            <div class="form-group text-center" style="margin-bottom:0%;">
                                <img style="height: 200px;border: 1px solid; border-radius: 10px;" id="viewer" src="{{ $master_merchant->logo }}" alt="">
                            </div>
                            @error('logo')
                                <br><span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cover_photo">Foto Cover</label><small style="color: red"> ( Ratio 2:1 )</small><br>
                            <input type="file" id="coverImageUpload" name="cover_photo">
                            <div class="form-group text-center" style="margin-bottom:0%;">
                                <img style="height: 200px;border: 1px solid; border-radius: 10px;" id="coverImageViewer" src="{{ $master_merchant->cover_photo }}" alt="">
                            </div>
                            @error('cover_photo')
                                <br><span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="seo_image">Gambar SEO</label><small style="color: red"> ( Ratio 1:1 )</small><br>
                            <input type="file" id="seoImageUpload" name="seo_image">
                            <div class="form-group text-center" style="margin-bottom:0%;">
                                <img style="height: 200px;border: 1px solid; border-radius: 10px;" id="seoImageViewer" src="{{ $master_merchant->seo_image }}" alt="">
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
                    <div class="card-header">Informasi Pemilik</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="f_name">Nama Depan</label>
                            <input type="text" id="f_name" name="f_name" value="{{ $master_merchant_vendor->f_name }}" class="form-control" >
                            @error('f_name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="l_name">Nama Belakang</label>
                            <input type="text" id="l_name" name="l_name" value="{{ $master_merchant_vendor->l_name }}" class="form-control">
                            @error('l_name')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">No. Handphone</label>
                            <input type="number" min="0" id="phone" name="phone" value="{{ $master_merchant_vendor->phone }}" class="form-control" >
                            @error('phone')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $master_merchant_vendor->email }}" class="form-control" >
                            @error('email')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
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
                            <label for="confirmPassword">Konfirmasi Kata Sandi</label>
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
                            <a href="{{ route('admin.master-category') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Kembali</a>
                            <button type="submit" id="buttonSubmit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Perbarui</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('extend')
<div class="modal fade" id="addCoordinate" tabindex="-1" role="dialog" aria-labelledby="addCoordinate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCoordinate">Ubah Koordiant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="address-input" name="address" class="form-control map-input" onchange="hideMaps()" autocomplete="off" placeholder="Masukkan Alamat Anda">
                <input type="hidden" name="latitude" id="address-latitude"/>
                <input type="hidden" name="longitude" id="address-longitude"/><br>
                <div style="width: 100%; height: 400px; display: none;" id="address-map"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg" data-dismiss="modal" onclick="setCoordinate()"><i class="pe-7s-diskette btn-icon-wrapper"></i>Perbarui</button>
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
            document.cookie = "lat=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            document.cookie = "lng=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
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
    </script>
@endsection

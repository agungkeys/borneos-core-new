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
          <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
            <div class="d-flex mb-3">
              <image src="{{env('PUBLIC_IMAGE')}}/images/logo.svg" />
              <div class="ml-2">
                <h5 class="mb-0 t-bold">Borneos</h5>
                <h5 class="mb-0">Merchant</h5>
                <h5 class="mb-0">Management</h5>
              </div>
            </div>
            <h4 class="mb-0"><span><b>Setel ulang kata sandi anda</b></span></h4>
            <div class="divider row"></div>
            <div>
                <form class="" method="POST" action="{{route('merchant.auth.forget.newpassword')}}">
                    @csrf
                    <input type="hidden" name="auth_token" value="{{ $auth_token }}">
                    <div class="form-group">
                        <label for="password">Masukkan Kata Sandi Baru Anda</label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" onkeyup="checkMatching()" value="{{ old('password') }}" id="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                            <input type="password" onkeyup="checkMatching()" value="{{ old('confirmPassword') }}" id="confirmPassword" name="confirmPassword" class="form-control"  placeholder="Konfirmasi Kata Sandi" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                            </div>
                        </div>
                        <span class="text-danger mt-2" id="messageMatching"></span>
                        @error('password')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary btn-lg" id="buttonSubmit" type="submit">Ubah</button>
                    </div>
                </form>
            </div>
            <div class="divider row"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
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

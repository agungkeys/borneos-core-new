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
            <h4 class="mb-0"><span><b>Temukan akun anda</b></span></h4>
            <div class="divider row"></div>
            <div>
                <form class="" method="POST" action="{{route('merchant.auth.forget.submit')}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="email" class="">Masukkan email yang telah terdaftar</label>
                                <input name="email" id="email" placeholder="Email here..." type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('merchant.auth.login') }}"class="btn btn-light btn-lg">Kembali</a>
                        <button class="btn btn-primary btn-lg" type="submit">Kirim</button>
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

</script>
@endsection

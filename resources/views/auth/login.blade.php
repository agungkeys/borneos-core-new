@extends('layouts.auth')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="app-container app-theme-white body-tabs-shadow">
  <div class="app-container">
    <div class="h-100">
      <div class="h-100 no-gutters row">
        <div class="d-none d-lg-block col-lg-4">
          <div class="slider-light">
            <div class="slick-slider">
              <div>
                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                  <div class="slide-img-bg" style="background-image: url('assets/images/originals/city.jpg');"></div>
                  <div class="slider-content">
                    <h3>Semangat 100jt Pertama!</h3>
                    <p>ArchitectUI is like a dream. Some think it's too good to be true! Extensive collection of unified React Boostrap Components and Elements. </p>
                  </div>
                </div>
              </div>
              <div>
                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                  <div class="slide-img-bg" style="background-image: url('assets/images/originals/citynights.jpg');"></div>
                  <div class="slider-content">
                    <h3>Scalable, Modular, Consistent</h3>
                    <p>Easily exclude the components you don't require. Lightweight, consistent Bootstrap based styles across all elements and components </p>
                  </div>
                </div>
              </div>
              <div>
                <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                  <div class="slide-img-bg" style="background-image: url('assets/images/originals/citydark.jpg');"></div>
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
            <div class="app-logo"></div>
            <h4 class="mb-0"><span class="d-block">Hi Selamat Datang,</span><span>Silakan masuk ke akun Anda</span></h4>
            <h6 class="mt-3">Tidak memiliki akun? <a href="#" class="text-primary">Daftar Sekarang</a></h6>
            <div class="divider row"></div>
            <div>
              <form class="" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                      <label for="email" class="">Email</label>
                      <input name="email" id="email" placeholder="Email here..." type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus />
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                      <label for="password" class="">Password</label>
                      <input name="password" id="password" placeholder="Password here..." type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" />
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="position-relative form-check">
                  <input name="remember" id="remember" type="checkbox" class="form-check-input" {{ old('remember') ? 'checked' : ''}} />
                  <label class="form-check-label" for="remember" class="form-check-label">Keep me logged in</label>
                </div>
                <div class="divider row"></div>
                <div class="d-flex align-items-center">
                  <div class="ml-auto"><a href="javascript:void(0);" class="btn-lg btn btn-link">Hubungi Admin Borneos</a><button class="btn btn-primary btn-lg" type="submit">Login to Dashboard</button></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

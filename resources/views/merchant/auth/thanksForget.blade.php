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
            <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9" style="min-width: 100%;min-height:100fr">
              <div id="step-3" class="tab-pane step-content" style="display: block;">
                  <div class="no-results">
                    <div class="swal2-icon swal2-success swal2-animate-success-icon">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span>
                        <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <div class="results-subtitle mt-4">Link setel ulang kata sandi telah dikirim</div>
                    <div class="results-title"><strong>Tolong cek email anda {{ $vendor->email }}</strong> untuk menyetel ulang kata sandi anda.</div>
                    <div class="mt-3 mb-3"></div>
                    <div class="text-center">
                        <a href="{{ route('merchant.auth.login') }}" class="btn-shadow btn-wide btn btn-success btn-lg">Finish</a>
                    </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

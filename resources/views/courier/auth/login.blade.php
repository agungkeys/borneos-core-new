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
                                            style="background-image: url('{{ asset(env('PUBLIC_ASSETS') . 'images/originals/courier01.jpg') }}');">
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
                                            style="background-image: url('{{ asset(env('PUBLIC_ASSETS') . 'images/originals/courier02.jpg') }}');">
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
                                            style="background-image: url('{{ asset(env('PUBLIC_ASSETS') . 'images/originals/courier03.jpg') }}');">
                                        </div>
                                        <div class="slider-content">
                                            <h3>Complex, but lightweight</h3>
                                            <p>
                                                We've included a lot of components that cover almost all use cases for any
                                                type of application.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <!-- <div class="app-logo">Merchant Management</div> -->
                            <div class="d-flex mb-3">
                                <image src="{{ env('PUBLIC_IMAGE') }}/images/logo.svg" />
                                <div class="ml-2">
                                    <h5 class="mb-0 t-bold">Borneos</h5>
                                    <h5 class="mb-0">Courier</h5>
                                    <h5 class="mb-0">Management</h5>
                                </div>
                            </div>
                            <h4 class="mb-0"><span class="d-block">Hi Selamat Datang,</span><span>Silahkan masuk ke akun
                                    kurir anda</span></h4>
                            <!-- <h6 class="mt-3">Tidak memiliki akun? <a href="#" class="text-primary">Daftar Sekarang</a></h6> -->
                            <div class="divider row"></div>
                            <div>
                                <form id="form" class="" method="POST"
                                    action="{{ route('courier.auth.login') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="email" class="">Email</label>
                                                <input name="email" id="email" placeholder="Email here..."
                                                    type="email" class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus />
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
                                                <input name="password" id="password" placeholder="Password here..."
                                                    type="password"
                                                    class="form-control @error('password') is-invalid @enderror" required
                                                    autocomplete="current-password" />
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider row"></div>
                                    <div class="d-flex align-items-center">
                                        <div class="ml-auto">
                                            <!-- <a href="javascript:void(0);" class="btn-lg btn btn-link">Hubungi Admin Borneos</a> -->
                                            <button id="buttonSubmit" class="btn btn-primary btn-lg"
                                                type="submit">Masuk</button>
                                            <a href="{{ route('courier.auth.register') }}"
                                                class="ml-2 btn btn-secondary btn-lg text-white">Daftar Mitra Kurir</a>
                                        </div>
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
@section('js')
    <script>
        //submit key enter
        document.getElementById('form').onkeyup = function(e) {
            if (e.keyCode === 13) {
                document.getElementById('buttonSubmit').click();
            }
            return true;
        }
    </script>
@endsection

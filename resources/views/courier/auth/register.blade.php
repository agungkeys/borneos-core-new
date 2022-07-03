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
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" class="form-control" name="phone" id="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="address_lat">Address latitude & longitude</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="address_lat" id="address_lat">
                                            <input type="text" class="form-control" name="address_lang" id="address_lang">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email & Password</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" id="email" required>
                                            <input type="password" class="form-control" style="max-width: 35%" name="password" id="password" required>
                                        </div>
                                    </div>
                                    <div class="text-center my-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img id="imgPreviewIdentity" style="height: 130px;min-height:130px;max-width:100%;" alt=""/>
                                            </div>
                                            <div class="col-md-6">
                                                <img id="imgPreviewProfile" style="height: 130px;min-height:130px;max-width:100%;" alt=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="identity_type">Type & Number Identity</label>
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
                                        <label for="identity_expired">Identity Expired</label>
                                        <input type="date" class="form-control" name="identity_expired" id="identity_expired">
                                    </div>

                                    <label for="identity_image">Identity Image</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload Image</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="previewImageOnIdentity()"" class="custom-file-input" id="identity_image" name="identity_image" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                                        </div>
                                    </div>

                                    <label for="profile_image">Profile Image</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon03">Upload Image</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="previewImageOnProfile()"" class="custom-file-input" id="profile_image" name="profile_image" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile03">Choose File</label>
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
                                        <label for="join_date">Join Date</label>
                                        <input type="date" class="form-control" name="join_date" id="join_date" required>
                                    </div>
                                    <div class="text-right mt-2">
                                        <a href="{{ route('admin.courier.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                                        <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
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
@endsection
@section('js')
<script>
    function previewImageOnIdentity() {
        imgPreviewIdentity.src=URL.createObjectURL(event.target.files[0])
    }
    function previewImageOnProfile() {
        imgPreviewProfile.src=URL.createObjectURL(event.target.files[0])
    }
</script>
@endsection

@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>
                        Add Courier
                        <div class="page-title-subheading">

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.courier.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                                @error('name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" name="phone" id="phone">
                                @error('phone')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="10"></textarea>
                                @error('address')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                @error('password')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address_lat">Address lat.</label>
                                <input type="text" class="form-control" name="address_lat" id="address_lat">
                                @error('address_lat')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address_lang">Address lang.</label>
                                <input type="text" class="form-control" name="address_lang" id="address_lang">
                                @error('address_lang')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="identity_type">Identity Type</label>
                                <select name="identity_type" id="identity_type" class="form-control">
                                    <option value="ktp">KTP</option>
                                    <option value="sim">SIM</option>
                                    <option value="kk">KK</option>
                                    <option value="default">Default</option>
                                </select>
                                @error('identity_type')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="identity_no">Identity No</label>
                                <input type="text" class="form-control" name="identity_no" id="identity_no">
                                @error('identity_no')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="identity_expired">Identity Expired</label>
                                <input type="date" class="form-control" name="identity_expired" id="identity_expired">
                                @error('identity_expired')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
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
                                @error('identity_image')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-center my-2">
                                <img id="imgPreviewIdentity" class="img-thumbnail" alt=""/>
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
                                @error('profile_image')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-center my-2">
                                <img id="imgPreviewProfile" class="img-thumbnail" alt=""/>
                            </div>

                            <div class="form-group">
                                <label for="badge">Badge</label>
                                <select name="badge" id="badge" class="form-control">
                                    <option value="new">New</option>
                                    <option value="level_1">Level 1</option>
                                    <option value="level_2">Level 2</option>
                                    <option value="level_3">Level 3</option>
                                </select>
                                @error('badge')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="join_date">Join Date</label>
                                <input type="date" class="form-control" name="join_date" id="join_date">
                                @error('join_date')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-right mt-2">
                                <a href="{{ route('admin.courier.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                                <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#coupon_type').on('change', function(){
            const selectedCouponType = $('#coupon_type').val();

            if (selectedCouponType == 'free_delivery'){
                $('#discount_type').prop('disabled', true)
                $('#discount_type').val('')
            }else{
                $('#discount_type').prop('disabled', false)
            }
        })

        function previewImageOnIdentity() {
            imgPreviewIdentity.src=URL.createObjectURL(event.target.files[0])
        }
        function previewImageOnProfile() {
            imgPreviewProfile.src=URL.createObjectURL(event.target.files[0])
        }
    </script>
@endsection

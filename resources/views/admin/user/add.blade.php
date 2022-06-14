@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-user icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Add Master User
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>
   
   <div class="row">
      <div class="col-md-12">
         <div class="main-card mb-12 card">
            <div class="card-body">
               <form action="{{ route('admin.master-user.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name">
                                @error('first_name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" id="phone" name="phone" class="form-control" placeholder="Phone">
                                @error('phone')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="multiselect-dropdown form-control" name="role" id="role" data-placeholder="Select Role . . ." required>
                                    <option disabled selected value="">Select Role ...</option>
                                    @foreach ($admin_roles as $admin_role)
                                        <option value="{{ $admin_role->id }}">{{ $admin_role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                @error('password')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file...</label>
                        </div>
                        @error('image')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="form-group text-center" style="margin-bottom:0%;">
                        <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
                    </div>
                    <div class="text-right mt-2">
                        <a href="{{ route('admin.master-user') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                        <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                    </div>
               </form>
            </div>
         </div>
      </div>
   </div>
     <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function () {
            readURL(this);
        });
    </script>
@endsection

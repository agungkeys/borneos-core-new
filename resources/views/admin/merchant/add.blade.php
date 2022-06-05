@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="metismenu-icon pe-7s-home icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Add Master Merchant
               <div class="page-title-subheading">
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-6">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <form action="" method="POST" enctype="multipart/form-data">
                {{-- @dd($main_categories) --}}
               {{-- <form action="{{ route('admin.master-merchant.store') }}" method="POST" enctype="multipart/form-data"> --}}
                  @csrf
                  <div class="form-group">
                     <label for="main_categories">Merchant Category</label>
                     <select name="main_categories" id="main_categories" multiple="multiple" class="multiselect-dropdown form-control">
                         @foreach ($main_categories as $main_category)
                             <option value="{{ $main_category['id'] }}">{{ $main_category['name'] }}</option>
                         @endforeach
                     </select>
                     @error('main_categories')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="name">Merchant Name</label>
                     <input type="text" id="name" name="name" class="form-control">
                     @error('name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="slug">Merchant Slug</label>
                     <input type="text" id="slug" name="slug" class="form-control">
                     @error('slug')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="district">Merchant District</label>
                     <input type="text" id="district" name="district" class="form-control">
                     @error('district')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="address">Merchant Address</label>
                     <textarea id="address" name="address" class="form-control"></textarea>
                     @error('address')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="tax">VAT/TAX (%)</label>
                    <input type="number" id="tax" name="tax" class="form-control" min="0" step=".01">
                     @error('tax')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  {{-- <div class="form-group">
                     <label for="image">Image</label><br>
                     <input type="file" accept="image/*" id="image" name="image">
                     @error('image')
                        <br><span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div> --}}
                  <div class="form-group text-center" style="margin-bottom:0%;">
                     <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
                  </div>
                  <div class="text-right mt-2">
                     <a href="{{ route('admin.master-category') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
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

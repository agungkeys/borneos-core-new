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
               Add Master Category
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body">
            <form action="{{ route('admin.master-category.store') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control">
                  @error('name')
                      <span class="text-danger mt-2">{{ $message }}</span>
                  @enderror
               </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" id="slug" name="slug" class="form-control">
                  @error('slug')
                     <span class="text-danger mt-2">{{ $message }}</span>
                  @enderror
               </div>
                <div class="form-group">
                  <label for="image">Image</label><br>
                  <input type="file" accept="image/*" id="image" name="image">
                  @error('image')
                      <br><span class="text-danger mt-2">{{ $message }}</span>
                  @enderror
               </div>
               <div class="form-group text-center" style="margin-bottom:0%;">
                  <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
               </div>
               <div class="text-center mt-2">
                  <button type="submit" style="border-radius: 25px;" class="btn btn-primary col-3"> Tambah</button>
                  <a href="{{ route('admin.master-category') }}" style="border-radius: 25px" class="btn btn-danger col-3"> Kembali</a>
               </div>
            </form>
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
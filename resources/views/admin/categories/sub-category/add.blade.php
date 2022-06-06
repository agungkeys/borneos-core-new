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
               Add Master Sub Category
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
                  <form action="{{ route('admin.master-sub-category.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                     @csrf
                     <div class="form-group">
                        <label for="category">Category</label>
                        <select class="multiselect-dropdown form-control select2" name="category" id="category" onchange="myFunction()">
                              <option disabled selected value="">Choose One!</option>
                              @foreach ($master_categories as $master_category)
                                 <option value="{{ $master_category->parent_id }}">{{ $master_category->name }}</option>
                              @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="sub-category-name">Sub Category Name</label>
                        <input type="text" id="sub-category-name" name="sub-category-name" class="form-control form-control">
                        @error('sub-category-name')
                           <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="sub-category-slug">Sub Category Slug</label>
                        <input type="text" id="sub-category-slug" name="sub-category-slug" class="form-control form-control">
                        @error('sub-category-slug')
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
          $.ajax({
                type: "GET",
                url: 'test.php',
                success: function(data){
                    console.log(data);
                }
            });
   
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

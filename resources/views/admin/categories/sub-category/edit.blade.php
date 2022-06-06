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
               Edit Master Sub Category
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
                  <form action="{{ route('admin.master-sub-category.update',$sub_category->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                     @method('PUT')
                     @csrf
                     <div class="form-group">
                        <label for="category">Category</label>
                        <select class="multiselect-dropdown form-control" name="category" id="category" required>
                              @foreach ($master_categories as $master_category)
                                 <option {{ $sub_category->parent_id == $master_category->parent_id ? 'selected':''  }} value="{{ $master_category->parent_id }}">{{ $master_category->name }}</option>
                              @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="sub-category-name">Sub Category Name</label>
                        <input type="text" id="sub-category-name" name="sub-category-name" value="{{ $sub_category->name }}" class="form-control form-control">
                        @error('sub-category-name')
                           <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="sub-category-slug">Sub Category Slug</label>
                        <input type="text" id="sub-category-slug" name="sub-category-slug" value="{{ $sub_category->slug }}" class="form-control form-control">
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
                        <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" src="{{ URL::to($sub_category->image) }}" alt=""/>
                     </div>
                     <div class="text-right mt-2">
                        <a href="{{ route('admin.master-sub-category') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                        <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                     </div>
                  </form>
            </div>
         </div>
      </div>
   </div>
     <script>
        $('.js-select2-custom').select2();
   
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

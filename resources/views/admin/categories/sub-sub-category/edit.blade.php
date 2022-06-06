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
               Edit Master Sub Sub Category
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
                  <form action="{{ route('admin.master-sub-sub-category.update',$sub_sub_category->id ) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                     @method('PUT')
                     @csrf
                     <div class="form-group">
                        <label for="sub-category">Category</label>
                        <select class="multiselect-dropdown form-control" name="sub-category" id="sub-category" required>
                              @foreach ($sub_categories as $sub_category)
                                 <option {{ $sub_sub_category->parent_id == $sub_category->id ? 'selected':''  }} value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                              @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="sub-sub-category-name">Sub-Sub Category Name</label>
                        <input type="text" id="sub-sub-category-name" name="sub-sub-category-name" value="{{ $sub_sub_category->name }}" class="form-control form-control">
                        @error('sub-sub-category-name')
                           <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="sub-sub-category-slug">Sub-Sub Category Slug</label>
                        <input type="text" id="sub-sub-category-slug" name="sub-sub-category-slug" value="{{ $sub_sub_category->slug }}" class="form-control form-control">
                        @error('sub-sub-category-slug')
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
                        <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" src="{{ URL::to($sub_sub_category->image) }}" alt=""/>
                     </div>
                     <div class="text-right mt-2">
                        <a href="{{ route('admin.master-sub-sub-category') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
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

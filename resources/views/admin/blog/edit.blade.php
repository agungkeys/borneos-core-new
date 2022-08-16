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
               Edit Master Blog
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="main-card mb-3 card">
      <div class="card-body">
         <form action="{{ route('admin.blog.update',$blog) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ $blog->title }}" class="form-control">
                        @error('title')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="js-data-example-ajax multiselect-dropdown form-control">
                            <option disabled selected value="">Choose One!</option>
                            @foreach ($categories as $category)
                                <option {{ $blog->blog_category_id == $category->id ?'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                         @error('category')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short_details">Short Details</label>
                        <textarea name="short_details" id="short_details" class="form-control">{{ $blog->short_details }}</textarea>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" class="form-control">{{ $blog->details }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
               <label for="image">Image</label><br>
               <input type="file" accept="image/*" id="image" name="image">
               @error('image')
                  <br><span class="text-danger mt-2">{{ $message }}</span>
               @enderror
            </div>
            <div class="form-group text-center" style="margin-bottom:0%;">
               <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" src="{{ URL::to($blog->image) }}" alt=""/>
            </div>
            <div class="text-right mt-2">
               <a href="{{ route('admin.blog.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
               <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
            </div>
         </form>
      </div>
   </div>
@endsection
@section('js')
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
        CKEDITOR.replace('details', {
          height: 300,
          removeButtons: 'PasteFromWord'
        });
    </script>
@endsection

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

    <div class="row">
        <div class="col-md-6">
            <div class="main-card card mb-3">
                <div class="card-body">
                    <form action="{{ route('admin.master-category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" id="name" name="name" class="form-control">
                            @error('name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control">
                            @error('slug')
                            <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input type="number" name="priority" id="priority" class="form-control">
                            @error('priority')
                            <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="image">Image</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload Image</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" accept="image/*" onchange="previewImageOnAdd()" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                            </div>
                            @error('image')
                            <br><span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group my-2 text-center">
                            <img id="imgpreview" class="img-thumbnail" alt="" />
                        </div>
                        <label for="image_banner">Image Banner</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload Image</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" accept="image/*" onchange="previewImageBannerOnAdd()" class="custom-file-input" id="image_banner" name="image_banner" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                            </div>
                            @error('image_banner')
                            <br><span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group my-2 text-center">
                            <img id="imgbannerpreview" class="img-thumbnail" alt="" />
                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                            <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt="" />
                        </div>
                        <div class="mt-2 text-right">
                            <a href="{{ route('admin.master-category') }}" class="btn btn-icon btn-light btn-lg mb-2 mr-2"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                            <button type="submit" class="btn btn-icon btn-primary btn-lg mb-2 mr-2"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script>
        function previewImageOnAdd() {
            imgpreview.src = URL.createObjectURL(event.target.files[0])
        }

        function previewImageBannerOnAdd() {
            imgbannerpreview.src = URL.createObjectURL(event.target.files[0])
        }
    </script>
    @endsection
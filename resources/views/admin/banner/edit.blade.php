@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-actions">
                        <a href="{{ route('admin.banner.index') }}" class="btn-shadow btn btn-info btn-lg"> <i class="fa fa-chevron-left"> </i> Back </a>
                    </div>
                    <h3 class="mx-3">Edit data banner</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value=" {{ $banner->title }} ">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" id="type" value=" {{ $banner->type }} ">
                            </div>

                            <label for="image">Image</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload Image</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" onchange="previewImageOnEdit()" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01" >Choose File</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url" value=" {{ $banner->url }} ">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" name="status" id="status" value=" {{ $banner->status }} ">
                            </div>
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="text" class="form-control" name="data" id="data" value=" {{ $banner->data }} ">
                            </div>
                            <div class="form-group">
                                <label for="admin_id">Admin ID</label>
                                <input type="text" class="form-control" name="admin_id" id="admin_id" value=" {{ $banner->admin_id }} ">
                            </div>
                            <div class="form-group">
                                <label for="zone_id">Zone ID</label>
                                <input type="text" class="form-control" name="zone_id" id="zone_id" value=" {{ $banner->zone_id }} ">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary mx-2"> <i class="pe-7s-diskette"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column w-100">
                                <p class="text-center font-weight-bold">Preview Image</p>
                                <img src="{{ $banner->image ? $banner->image : asset('images/default-image.jpg') }}" class="w-100" alt="" id="imgpreview">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-actions">
                        <a href="{{ route('admin.banner.index') }}" class="btn-shadow btn btn-info btn-lg"> <i class="fa fa-chevron-left"> </i> Back </a>
                    </div>
                    <h3 class="mx-3">Add data banner</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" id="type">
                            </div>
                            <label for="image">Image</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload Image</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" onchange="preview()" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="text" class="form-control" name="data" id="data">
                            </div>
                            <div class="form-group">
                                <label for="admin_id">Admin ID</label>
                                <input type="text" class="form-control" name="admin_id" id="admin_id" >
                            </div>
                            <div class="form-group">
                                <label for="zone_id">Zone ID</label>
                                <input type="text" class="form-control" name="zone_id" id="zone_id" >
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary mx-2"> <i class="pe-7s-diskette"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

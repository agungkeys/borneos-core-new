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
                        Edit Banner
                        <div class="page-title-subheading">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.banner.update', $banner) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ $banner->title }}">
                                @error('title')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="multiselect-dropdown form-control form-control" required>
                                    <option {{ $banner->type == 'banner_potrait' ? 'selected':'' }} value="banner_potrait">Banner Potrait</option>
                                    <option {{ $banner->type == 'banner_landing' ? 'selected':'' }} value="banner_landing">Banner Landing</option>
                                    <option {{ $banner->type == 'banner_merchant' ? 'selected':'' }} value="banner_merchant">Banner Merchant</option>
                                    <option {{ $banner->type == 'banner' ? 'selected':'' }} value="banner">Banner</option>
                                </select>
                                @error('type')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="merchant_id">Merchant</label>
                                <select name="merchant_id" id="merchant_id" class="multiselect-dropdown form-control form-control" disabled>
                                    <option disabled selected></option>
                                    @foreach ($merchants as $merchant)
                                        <option {{ $banner->merchant_id == $merchant->id ? 'selected':'' }} value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                    @endforeach
                                </select>
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
                            <div class="form-group text-center my-2">
                                <img src="{{ $banner->image }}" id="imgpreview" class="img-thumbnail" alt=""/>
                            </div>

                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" name="url" id="url" value="{{ $banner->url }}">
                            </div>

                            <div class="text-right mt-2">
                                <a href="{{ route('admin.banner.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                                <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#type').on('change', function(){
            const selectedTypeBanner = $('#type').val();

            if (selectedTypeBanner == 'banner_merchant'){
                $('#merchant_id').prop('disabled', false)
            }else{
                $('#merchant_id').append("<option disabled selected></option>");
                $('#merchant_id').prop('disabled', true)
            }
        })

        const selectedTypeBanner = $('#type').val();

        if (selectedTypeBanner == 'banner_merchant'){
            $('#merchant_id').prop('disabled', false)
        }else{
            $('#merchant_id').prop('disabled', true)
        }

        function previewImageOnEdit() {
            imgpreview.src=URL.createObjectURL(event.target.files[0])
        }
    </script>
@endsection

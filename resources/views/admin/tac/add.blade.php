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
                        Add Term and Condition
                        <div class="page-title-subheading">

                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.tac.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="editor" class="form-control"></textarea>
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
                            </div>
                            <div class="form-group text-center my-2">
                                <img id="imgpreview" class="img-thumbnail" alt=""/>
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="number" class="form-control" name="position" id="position">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="merchant">Merchant</option>
                                    <option value="courier">Courier</option>
                                    <option value="general">General</option>
                                </select>
                            </div>
                            <div class="text-right mt-2">
                                <a href="{{ route('admin.tac') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                                <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
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
        function previewImageOnAdd() {
            imgpreview.src=URL.createObjectURL(event.target.files[0])
        }
    </script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        let content = document.getElementById('editor')
        CKEDITOR.replace(content, {
            language: 'en-gb'
        })
        CKEDITOR.config.allowedContent = true;
    </script>
@endsection

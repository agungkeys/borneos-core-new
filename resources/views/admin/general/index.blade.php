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
                        Generals
                        <div class="page-title-subheading">

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if ($generals->count() == 0)
                            <form action="{{ route('admin.general.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>

                                <label for="logo">Logo</label>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload logo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" onchange="previewLogo()" class="custom-file-input" id="logo" name="logo" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01" >Choose File</label>
                                    </div>
                                </div>
                                <div class="form-group text-center my-2">
                                    <img src="" id="imgpreviewLogo" class="img-thumbnail" alt=""/>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address_lat">Address Lat</label>
                                    <input type="text" class="form-control" name="address_lat" id="address_lat">
                                </div>
                                <div class="form-group">
                                    <label for="address_lng">Address Long</label>
                                    <input type="text" class="form-control" name="address_lng" id="address_lng">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" name="phone" id="phone">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="footer_text">Footer Text</label>
                                    <textarea name="footer_text" id="footer_text" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="seo_title">SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title" id="seo_title">
                                </div>
                                <div class="form-group">
                                    <label for="seo_description">SEO Description</label>
                                    <textarea name="seo_description" id="seo_description" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="seo_author">SEO Author</label>
                                    <input type="text" class="form-control" name="seo_author" id="seo_author">
                                </div>
                                <div class="form-group">
                                    <label for="seo_keyword">SEO Keywords</label>
                                    <input type="text" class="form-control" name="seo_keyword" id="seo_keyword">
                                </div>
                                 <label for="seo_image">SEO Image</label>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload SEO Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" onchange="previewSeoImage()" class="custom-file-input" id="seo_image" name="seo_image" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01" >Choose File</label>
                                    </div>
                                </div>
                                <div class="form-group text-center my-2">
                                    <img src="" id="imgpreviewSeo" class="img-thumbnail" alt=""/>
                                </div>
                                <div class="form-group">
                                    <label for="seo_twitter_link">SEO Twitter Link</label>
                                    <input type="text" class="form-control" name="seo_twitter_link" id="seo_twitter_link">
                                </div>
                                <div class="form-group">
                                    <label for="seo_facebook_link">SEO Facebook Link</label>
                                    <input type="text" class="form-control" name="seo_facebook_link" id="seo_facebook_link">
                                </div>
                                <div class="form-group">
                                    <label for="min_delivery_charge">Min Delivery Charge</label>
                                    <input type="number" class="form-control" name="min_delivery_charge" id="min_delivery_charge">
                                </div>
                                <div class="form-group">
                                    <label for="min_charge_per_km">Min Charge Per KM</label>
                                    <input type="number" class="form-control" name="min_charge_per_km" id="min_charge_per_km">
                                </div>
                                <div class="form-group">
                                    <label for="delivery_charge_per_km">Delivery Charge Per KM</label>
                                    <input type="number" class="form-control" name="delivery_charge_per_km" id="delivery_charge_per_km">
                                </div>

                                <div class="text-right mt-2">
                                    <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                                </div>
                            </form>
                        @else
                            @foreach ($generals as $general)
                            <form action="{{ route('admin.general.update', $general->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $general->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ $general->description }}</textarea>
                                </div>

                                <label for="logo">Logo</label>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload logo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" onchange="previewLogo()" class="custom-file-input" id="logo" name="logo" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01" >Choose File</label>
                                    </div>
                                </div>
                                <div class="form-group text-center my-2">
                                    <img src="{{ $general->logo ? $general->logo : asset('images/default-image.jpg')  }}" id="imgpreviewLogo" class="img-thumbnail" alt=""/>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control"> {{ $general->address }}  </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address_lat">Address Lat</label>
                                    <input type="text" class="form-control" name="address_lat" id="address_lat" value="{{ $general->address_lat }}">
                                </div>
                                <div class="form-group">
                                    <label for="address_lng">Address Long</label>
                                    <input type="text" class="form-control" name="address_lng" id="address_lng" value="{{ $general->address_lng }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" name="phone" id="phone" value="{{ $general->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ $general->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="footer_text">Footer Text</label>
                                    <textarea name="footer_text" id="footer_text" class="form-control" cols="30" rows="10">{{ $general->footer_text }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="seo_title">SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title" id="seo_title" value="{{ $general->seo_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="seo_description">SEO Description</label>
                                    <textarea name="seo_description" id="seo_description" class="form-control" cols="30" rows="10">{{ $general->seo_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="seo_author">SEO Author</label>
                                    <input type="text" class="form-control" name="seo_author" id="seo_author" value="{{ $general->seo_author }}">
                                </div>
                                <div class="form-group">
                                    <label for="seo_keywords">SEO Keywords</label>
                                    <input type="text" class="form-control" name="seo_keywords" id="seo_keywords" value="{{ $general->seo_keywords }}">
                                </div>
                                 <label for="seo_image">SEO Image</label>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload SEO Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" onchange="previewSeoImage()" class="custom-file-input" id="seo_image" name="seo_image" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01" >Choose File</label>
                                    </div>
                                </div>
                                <div class="form-group text-center my-2">
                                    <img src="{{ $general->seo_image }}" id="imgpreviewSeo" class="img-thumbnail" alt=""/>
                                </div>
                                <div class="form-group">
                                    <label for="seo_twitter_link">SEO Twitter Link</label>
                                    <input type="text" class="form-control" name="seo_twitter_link" id="seo_twitter_link" value="{{ $general->seo_twitter_link }}">
                                </div>
                                <div class="form-group">
                                    <label for="seo_facebook_link">SEO Facebook Link</label>
                                    <input type="text" class="form-control" name="seo_facebook_link" id="seo_facebook_link" value="{{ $general->seo_facebook_link }}">
                                </div>
                                <div class="form-group">
                                    <label for="maintenance_mode">Maintenance</label> <br>
                                    <label class="m-auto align-middle" for="statusCheckbox{{$general->id}}">
                                            <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.general.maintenance',[$general['id'], $general->maintenance_mode ? 0 : 1])}}'" id="statusCheckbox{{$general->id}}" {{$general->maintenance_mode ? 'checked' : ''}}>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="min_delivery_charge">Min Delivery Charge</label>
                                    <input type="number" class="form-control" name="min_delivery_charge" id="min_delivery_charge" value="{{ $general->min_delivery_charge }}">
                                </div>
                                <div class="form-group">
                                    <label for="min_charge_per_km">Min Charge Per KM</label>
                                    <input type="number" class="form-control" name="min_charge_per_km" id="min_charge_per_km" value="{{ $general->min_charge_per_km }}">
                                </div>
                                <div class="form-group">
                                    <label for="delivery_charge_per_km">Delivery Charge Per KM</label>
                                    <input type="number" class="form-control" name="delivery_charge_per_km" id="delivery_charge_per_km" value="{{ $general->delivery_charge_per_km }}">
                                </div>

                                <div class="text-right mt-2">
                                    <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                                </div>
                            </form>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('sweetalert::alert')
        <script>

            function delete_coupon(id)
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to delete this file!?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                    let _token =  $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "DELETE",
                        url: "/admin/coupon/"+id,
                        data: {_token:_token,id:id},
                        success:function(response){
                            if(response.status == 200){
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                                window.location = "{{ route('admin.coupon.index') }}";
                            }
                        }
                        });
                    }
                })
            }
        </script>
        <script>
            function previewLogo() {
                imgpreviewLogo.src=URL.createObjectURL(event.target.files[0])
            }
            function previewSeoImage() {
                imgpreviewSeo.src=URL.createObjectURL(event.target.files[0])
            }
        </script>
@endsection

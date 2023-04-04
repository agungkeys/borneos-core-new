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
                        Edit Data Passenger
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
                        <form action="{{ route('admin.travel.update', $travel->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="prefix">Prefix</label>
                                <input type="text" class="form-control" name="prefix" id="prefix" value="{{ $travel->prefix }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" value="{{ $travel->fullname }}">
                                 @error('fullname')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control" name="telp" id="telp" value="{{ $travel->telp }}">
                                 @error('telp')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="full_address">Full Address</label>
                                <textarea class="form-control" name="full_address" id="full_address"> {{ $travel->full_address }} </textarea>
                                 @error('address')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sub_district">Sub District</label>
                                <input type="text" class="form-control" name="sub_district" id="sub_district" value="{{ $travel->sub_district }}">
                                 @error('sub_district')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" class="form-control" name="district" id="district" value="{{ $travel->district }}">
                                 @error('district')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($travel->approved_at == !null)
                                <div class="form-group">
                                    <label for="approved">Approved</label>
                                    <label class="m-auto align-middle" for="statusCheckbox{{$travel->id}}">
                                        <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.travel.approved', $travel->id)}}'" id="statusCheckbox{{$travel->id}}" {{$travel->approved ? 'checked' : ''}}>
                                    </label>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="route">Route</label>
                                <select name="route" id="route" class="multiselect-dropdown form-control form-control" required>
                                    <option {{ $travel->route === 'BTG-SMD' ? 'selected':'' }} value="BTG-SMD"> Bontang - Samarinda </option>
                                    <option {{ $travel->route === 'BTG-BPN' ? 'selected':'' }} value="BTG-BPN"> Bontang - Balikpapan </option>
                                    <option {{ $travel->route === 'SMD-BJM' ? 'selected':'' }} value="SMD-BJM"> Samarinda - Banjarmasin </option>
                                </select>
                                @error('seat_no')
                                <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="seat_no">Seat No.</label>
                                <select name="seat_no" id="seat_no" class="multiselect-dropdown form-control form-control" required>
                                    <option {{ $travel->seat_no ? 'selected':'' }} value="{{ $travel->seat_no }}"> {{ $travel->seat_no }} </option>
                                </select>
                                @error('seat_no')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="url_idcard">URL ID Card</label>
                                <input type="text" class="form-control" name="url_idcard" id="url_idcard" value="{{ $travel->url_idcard }}">
                                 @error('url_idcard')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="url_idvaccine">URL ID Vaccine</label>
                                <input type="text" class="form-control" name="url_idvaccine" id="url_idvaccine" value="{{ $travel->url_idvaccine }}">
                                 @error('url_idvaccine')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-right mt-2">
                                <a href="{{ route('admin.travel.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
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

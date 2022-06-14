@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-photo-gallery icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>List Courier <span class="badge badge-pill badge-primary">{{ number_format($couriers->total(), 0, "", ".") }}</span></div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.coupon.create') }}" class="btn-shadow btn btn-info btn-lg">Add Courier</a>
                </div>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12 col-md-5">
                        <div class="d-flex">
                            <form class="form-inline" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="fa fa-search fa-w-16 "></i>
                                        </div>
                                    </div>
                                    <input id="filter" name="filter" value="{{ $filter }}" placeholder="Search Title" type="text" class="form-control" style="color: gray;">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary btn-md">Search</buttton>
                                    </div>
                                </div>
                            </form>
                            <form class="form-inline" method="GET">
                                <button class="btn btn-light btn-lg ml-2">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table" id="couponsTable">
                        <thead>
                            <tr>
                                <th>@sortablelink('id', 'No')</th>
                                <th>@sortablelink('name', 'Name')</th>
                                <th>@sortablelink('phone', 'Phone')</th>
                                <th>Address</th>
                                <th>Address Lat</th>
                                <th>Address Lang</th>
                                <th>Identity Type</th>
                                <th>Identity Number</th>
                                <th>Identity Expired</th>
                                <th>Identity Image</th>
                                <th>Identity Additional Image</th>
                                <th>Profile Image</th>
                                <th>Profile Additional Image</th>
                                <th>Badge</th>
                                <th>@sortablelink('status', 'Status')</th>
                                <th>@sortablelink('join_date', 'Join Date')</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($couriers->count() == 0)
                                <tr>
                                    <td colspan="8">No products to display</td>
                                </tr>
                            @endif

                            @foreach ($couriers as $courier )
                                <tr>
                                    <td>{{ $courier->id }}</td>
                                    <td>{{ $courier->name }}</td>
                                    <td>{{ $courier->phone }}</td>
                                    <td>{{ $courier->address }}</td>
                                    <td>{{ $courier->address_lat ? $courier->address_lat : "-" }}</td>
                                    <td>{{ $courier->address_lang ? $courier->address_lang : "-" }}</td>
                                    <td>{{ $courier->identity_type ? $courier->identity_type : "-" }}</td>
                                    <td>{{ $courier->identity_no ? $courier->identity_no : "-" }}</td>
                                    <td>{{ $courier->identity_expired ? $courier->identity_expired : "-" }}</td>
                                    <td>{{ $courier->identity_image ? $courier->identity_image : "-" }}</td>
                                    <td>{{ $courier->identity_additional_image ? $courier->identity_additional_image : "-" }}</td>
                                    <td>{{ $courier->profile_image ? $courier->profile_image : "-" }}</td>
                                    <td>{{ $courier->profile_additional_image ? $courier->profile_additional_image : "-" }}</td>
                                    <td>{{ $courier->badge ? $courier->badge : "-" }}</td>
                                    <td>
                                        <label class="m-auto align-middle" for="statusCheckbox{{$courier->id}}">
                                            <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.courier.status',[$courier['id'],$courier->status ? 0 : 1])}}'" id="statusCheckbox{{$courier->id}}" {{$courier->status ? 'checked' : ''}}>
                                        </label>
                                    </td>
                                    <td>{{ $courier->join_date ? $courier->join_date : "-" }}</td>
                                    <td>
                                         <a href="{{ route('admin.courier.edit',$courier->id) }}" class="btn btn-warning btn-sm"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>

                                        <button type="button" onclick="delete_courier({{$courier->id}})" class="btn btn-danger btn-sm"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 col-md-6 flex-1">
                            {!! $couriers->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                        </div>
                        <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                            <p>Displaying {{$couriers->count()}} of {{ number_format($couriers->total(), 0, "", ".") }} product(s).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         @include('sweetalert::alert')
        <script>

            function delete_courier(id)
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
                        url: "/admin/courier/"+id,
                        data: {_token:_token,id:id},
                        success:function(response){
                            if(response.status == 200){
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                                window.location = "{{ route('admin.courier.index') }}";
                            }
                        }
                        });
                    }
                })
            }
        </script>
    </div>
@endsection

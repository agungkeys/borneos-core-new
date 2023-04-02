@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-photo-gallery icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>List Travels <span class="badge badge-pill badge-primary">{{ number_format($travels->total(), 0, "", ".") }}</span></div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.banner.create') }}" class="btn-shadow btn btn-info btn-lg">Add Travel</a>
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
                                    <input id="filter" name="filter" value="{{ $filter }}" placeholder="Search" type="text" class="form-control" style="color: gray;" autocomplete="off">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary btn-md">Search</button>
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
                    <table class="table" id="bannerTable">
                        <thead>
                            <tr>
                                <th>@sortablelink('id', 'ID')</th>
                                <th>Prefix</th>
                                <th>Fullname</th>
                                <th>Telp</th>
                                <th>Full Address</th>
                                <th>@sortablelink('sub_district', 'Sub District')</th>
                                <th>@sortablelink('district', 'District')</th>
                                <th>Route</th>
                                <th>@sortablelink('seat_no', 'Seat Number')</th>
                                <th>URL ID Card</th>
                                <th>URL ID Vaccine</th>
                                <th>Approved at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($travels->count() == 0)
                                <tr>
                                    <td colspan="8">No data to display</td>
                                </tr>
                            @endif

                            @foreach ($travels as $travel )
                                <tr>
                                    <td>{{ $travel->id }}</td>
                                    <td>{{ $travel->prefix ? $travel->prefix : '-' }}</td>
                                    <td>{{ $travel->fullname ? $travel->fullname : "-" }}</td>
                                    <td>{{ $travel->telp ? $travel->telp : "-" }}</td>
                                    <td>{{ $travel->full_address ? $travel->full_address : "-" }}</td>
                                    <td>{{ $travel->sub_district ? $travel->sub_district : "-" }}</td>
                                    <td>{{ $travel->district ? $travel->district : "-" }}</td>
                                    <td>{{ $travel->route ? $travel->route : "-" }}</td>
                                    <td>{{ $travel->seat_no ? $travel->seat_no : "-" }}</td>
                                    <td>{{ $travel->url_idcard ? $travel->url_idcard : "-" }}</td>
                                    <td>{{ $travel->url_idvaccine ? $travel->url_idvaccine : "-" }}</td>
                                    <td>{{ $travel->approved_at ? $travel->approved_at : "-" }}</td>
                                    <td>
                                         <a href="{{ route('admin.banner.edit',$travel) }}" class="btn btn-warning btn-sm"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                                        <button type="button" onclick="delete_banner({{$travel->id}})" class="btn btn-danger btn-sm"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 col-md-6 flex-1">
                            {!! $travels->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                        </div>
                        <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                            <p>Displaying {{$travels->count()}} of {{ number_format($travels->total(), 0, "", ".") }} data(s).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                    <table class="table table-striped table-bordered table-hover" id="bannerTable">
                        <thead>
                            <tr>
                                <th>@sortablelink('id', 'ID')</th>
                                <th>Prefix</th>
                                <th>Fullname</th>
                                <th>@sortablelink('sub_district', 'Sub District')</th>
                                <th>@sortablelink('district', 'District')</th>
                                <th>Route</th>
                                <th>@sortablelink('seat_no', 'Seat Number')</th>
                                {{-- <th>URL ID Card</th>
                                <th>URL ID Vaccine </th> --}}
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
                                    <td>  <a href="{{ route('admin.travel.show',$travel->id) }}"> {{ $travel->id }} </a></td>
                                    <td>{{ $travel->prefix ? $travel->prefix : '-' }}</td>
                                    <td>{{ $travel->fullname ? $travel->fullname : "-" }}</td>
                                    <td>{{ $travel->sub_district ? $travel->sub_district : "-" }}</td>
                                    <td>{{ $travel->district ? $travel->district : "-" }}</td>
                                    <td>{{ $travel->route ? $travel->route : "-" }}</td>
                                    <td>{{ $travel->seat_no ? $travel->seat_no : "-" }}</td>
                                    <td>{!! $travel->approved_at ? \Carbon\Carbon::parse($travel->approved_at)->toDayDateTimeString() : '<p class="text-danger font-weight-bold">Not Approved</p>' !!} </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-dark">Actions</button>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-hover-link dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                                @if ($travel->seat_no && $travel->approved_at)
                                                    <a href="{{ route('admin.travel.show',$travel) }}" class="dropdown-item"><i style="font-size: 14px" class="dropdown-icon fa fa-check text-success"></i>Send Ticket to Customer</a>
                                                @endif
                                                <a href="{{ route('admin.travel.show',$travel->id) }}" class="dropdown-item"><i style="font-size: 14px" class="dropdown-icon text-primary pe-7s-note2"></i>Detail</a>
                                                <a href="{{ route('admin.travel.edit',$travel->id) }}" class="dropdown-item"><i style="font-size: 14px" class="dropdown-icon text-warning pe-7s-note"></i>Edit</a>
                                               <button type="button" onclick="delete_banner({{$travel->id}})" class="dropdown-item"><i style="font-size: 14px" class="pe-7s-trash text-danger mr-2"></i>Delete</button>
                                            </div>
                                        </div>
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

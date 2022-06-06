@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-photo-gallery icon-gradient bg-tempting-azure"></i>
                    </div>
                    <h3>List Banner</h3>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.banner.create') }}" class="btn-shadow btn btn-info btn-lg">Add Banner</a>
                </div>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped-table-bordered" id="bannerTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Admin ID</th>
                                <th>Zone ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php
                                $no = 1
                            @endphp
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $banner->title }}</td>
                                    <td>{{ $banner->type }}</td>
                                    <td>
                                        <img src="{{ $banner->image }}" alt="{{ $banner->title }}" width="100">
                                    </td>
                                    <td>{{ $banner->url }}</td>
                                    <td>
                                        <input id="chkToggle1" type="checkbox" data-toggle="toggle" {{ $banner->status == 1 ? 'checked' : '' }} >
                                    </td>
                                    <td>{{ $banner->data }}</td>
                                    <td>{{ $banner->admin_id }}</td>
                                    <td>{{ $banner->zone_id }}</td>
                                    <td class="d-flex w-100">
                                        <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST">

                                            <a title="Edit" class="btn btn-success" href="{{ route('admin.banner.edit', $banner->id) }}" tooltip="Edit"> <i class="fas fa-pen"></i></a>

                                            @csrf
                                            @method('DELETE')

                                            <button title="Delete" type="submit" class="btn btn-danger" onclick="confirm('Are you sure???')"> <i class="fas fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

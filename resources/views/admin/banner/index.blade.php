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


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-news-paper icon-gradient bg-tempting-azure">
                        </i>
                    </div>
                    <h3>Data Passenger</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <a href="/admin/travel" class="text-secondary mb-3" style="display: flex; align-items: center; text-decoration: none;"><i class="pe-7s-angle-left" style="font-size: 2rem;"></i>Back to Order List</a>
            </div>
        </div>
        <div class="main-card mb-3 card" style="border-radius: 1.5em">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Prefix</th>
                            <th>Fullname</th>
                            <th>Telp</th>
                            <th>Full Address</th>
                            <th>Sub District</th>
                            <th>District</th>
                            <th>Route</th>
                            <th>Seat No.</th>
                            <th>URL ID Card</th>
                            <th>URL ID Vaccine </th>
                            <th>Approved at</th>
                        </thead>
                        <tbody>
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
                                <td>{!! $travel->approved_at ? $travel->approved_at : '<p class="text-danger font-weight-bold">Not Approved</p>' !!} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- @if ($travel->seat_no && $travel->approved_at)
                    <a href="" class="btn btn-success">Send Ticket to Customer</a>
                @else
                    <a href="{{ route('admin.travel.approved', $travel->id) }}" class="btn btn-primary"><i class="pe-7s-like2 mr-2"></i> Approve Ticket</a>
                    <button class="btn btn-success" disabled><i class="pe-7s-paper-plane mr-2"></i> Send Ticket to Customer</button>
                @endif --}}
            </div>
        </div>
    </div>
@endsection

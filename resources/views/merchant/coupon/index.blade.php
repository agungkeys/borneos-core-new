@extends('layouts.app-merchant')

@section('content')
    <script>
        window.location = "/merchant/comming-soon";
    </script>
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-photo-gallery icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>List Coupon <span
                            class="badge badge-pill badge-primary">{{ number_format($coupons->total(), 0, '', '.') }}</span>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('merchant.master-coupon.create') }}" class="btn-shadow btn btn-info btn-lg">Add
                        Coupons</a>
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
                                    <input id="filter" name="filter" value="{{ $filter }}"
                                        placeholder="Search by Title" type="text" class="form-control"
                                        style="color: gray;">
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
                                <th>@sortablelink('title', 'Title')</th>
                                <th>Coupon Type</th>
                                <th>Merchant Name</th>
                                <th>Code</th>
                                <th>Limit</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Discount Type</th>
                                <th>Discount</th>
                                <th>Max Discount</th>
                                <th>Min Purchase</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($coupons->count() == 0)
                                <tr>
                                    <td colspan="8">No coupons to display</td>
                                </tr>
                            @endif

                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->title }}</td>
                                    <td>{{ $coupon->coupon_type ? $coupon->coupon_type : '-' }}</td>
                                    <td>{{ $coupon->merchantName($coupon->merchant_id) }}</td>
                                    <td>{{ $coupon->code ? $coupon->code : '-' }}</td>
                                    <td>{{ $coupon->limit_same_user ? $coupon->limit_same_user : '-' }}</td>
                                    <td>{{ $coupon->date_start ? $coupon->date_start : '-' }}</td>
                                    <td>{{ $coupon->date_end ? $coupon->date_end : '-' }}</td>
                                    <td>{{ $coupon->discount_type ? $coupon->discount_type : '-' }}</td>
                                    <td>{{ $coupon->discount ? $coupon->discount : '-' }}</td>
                                    <td>{{ $coupon->max_discount ? $coupon->max_discount : '-' }}</td>
                                    <td> Rp. {{ $coupon->min_purchase ? number_format($coupon->min_purchase) : '-' }}</td>
                                    <td>
                                        <label class="m-auto align-middle" for="statusCheckbox{{ $coupon->id }}">
                                            <input type="checkbox" data-toggle="toggle" data-size="small"
                                                onChange="location.href='{{ route('merchant.master-coupon.status', [$coupon['id'], $coupon->status ? 0 : 1]) }}'"
                                                id="statusCheckbox{{ $coupon->id }}"
                                                {{ $coupon->status ? 'checked' : '' }}>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="{{ route('merchant.master-coupon.edit', $coupon->id) }}"
                                            class="btn btn-warning btn-sm"><i style="font-size: 14px"
                                                class="text-white pe-7s-note"></i></a>

                                        <button type="button" onclick="delete_coupon({{ $coupon->id }})"
                                            class="btn btn-danger btn-sm"><i style="font-size: 14px"
                                                class="pe-7s-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 col-md-6 flex-1">
                            {!! $coupons->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                        </div>
                        <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                            <p>Displaying {{ $coupons->count() }} of {{ number_format($coupons->total(), 0, '', '.') }}
                                product(s).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function delete_coupon(id) {
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
                        let _token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: "DELETE",
                            url: "/merchant/master-coupon/" + id,
                            data: {
                                _token: _token,
                                id: id
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    window.location = "{{ route('merchant.master-coupon') }}";
                                }
                            }
                        });
                    }
                })
            } <
            /scrip> <
            /div>
        @endsection

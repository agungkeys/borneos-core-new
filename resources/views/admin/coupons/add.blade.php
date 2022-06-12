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
                        Add Master Coupon
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
                        <form action="{{ route('admin.coupon.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="coupon_type">Coupon Type</label>
                                <select name="coupon_type" id="coupon_type" class="form-control" required>
                                    <option value="merchant_wise">Merchant Wise</option>
                                    <option value="free_delivery">Free Delivery</option>
                                    <option value="first_order">First Order</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="merchant_id">Merchant</label>
                                <select name="merchant_id" id="merchant_id" class="multiselect-dropdown form-control" >
                                    @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}"> {{ $merchant->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" id="code">
                            </div>
                            <div class="form-group">
                                <label for="limit_same_user">Limit Same User</label>
                                <input type="text" class="form-control" name="limit_same_user" id="limit_same_user">
                            </div>
                            <div class="form-group">
                                <label for="date_start">Date Start</label>
                                <input type="date" class="form-control" name="date_start" id="date_start">
                            </div>
                            <div class="form-group">
                                <label for="date_end">Date End</label>
                                <input type="date" class="form-control" name="date_end" id="date_end">
                            </div>
                            <div class="form-group">
                                <label for="discount_type">Discount Type</label>
                                <select name="discount_type" id="discount_type" class="form-control">
                                    <option value="amount">Amount</option>
                                    <option value="percent">Percent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" class="form-control" name="discount" id="discount" min="0">
                            </div>
                            <div class="form-group">
                                <label for="max_discount">Max Discount</label>
                                <input type="number" class="form-control" name="max_discount" id="max_discount" min="0">
                            </div>
                            <div class="form-group">
                                <label for="min_purchase">Minimal Purchase</label>
                                <input type="number" class="form-control" name="min_purchase" id="min_purchase" min="0">
                            </div>
                            <div class="text-right mt-2">
                                <a href="{{ route('admin.coupon.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                                <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#coupon_type').on('change', function(){
            const selectedCouponType = $('#coupon_type').val();

            if (selectedCouponType == 'free_delivery'){
                $('#discount_type').prop('disabled', true)
                $('#discount_type').val('')
            }else{
                $('#discount_type').prop('disabled', false)
            }
        })

        function previewImageOnAdd() {
            imgpreview.src=URL.createObjectURL(event.target.files[0])
        }
    </script>
@endsection

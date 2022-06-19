@extends('layouts.app-merchant')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>
                        Edit Coupon
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
                        <form action="{{ route('merchant.master-coupon.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ $coupon->title }}">
                            </div>
                            <div class="form-group">
                                <label for="coupon_type">Coupon Type</label>
                                <select name="coupon_type" id="coupon_type" class="form-control" required>
                                    @php
                                        $types = array(
                                            'merchant_wise' => array(
                                                'id' => 1,
                                                'value' => 'merchant_wise',
                                                'text' => 'Merchant Wise'
                                            ),
                                            'free_delivery' => array(
                                                'id' => 2,
                                                'value' => 'free_delivery',
                                                'text' => 'Free Delivery'
                                            ),
                                            'first_order' => array(
                                                'id' => 3,
                                                'value' => 'first_order',
                                                'text' => 'First Order'
                                            ),
                                            'default' => array(
                                                'id' => 4,
                                                'value' => 'default',
                                                'text' => 'Default'
                                            ),
                                        );
                                    @endphp

                                    @foreach ($types as $type)
                                         <option value="{{ $type['value'] }}" @if (old('type') == $coupon->coupon_type || $coupon->coupon_type == $type['value'] ) selected @endif>{{ $type['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" id="code" value="{{ $coupon->code }}">
                            </div>
                            <div class="form-group">
                                <label for="limit_same_user">Limit Same User</label>
                                <input type="text" class="form-control" name="limit_same_user" id="limit_same_user" value="{{ $coupon->limit_same_user }}">
                            </div>
                            <div class="form-group">
                                <label for="date_start">Date Start</label>
                                <input type="date" class="form-control" name="date_start" id="date_start" value="{{ $coupon->date_start }}">
                            </div>
                            <div class="form-group">
                                <label for="date_end">Date End</label>
                                <input type="date" class="form-control" name="date_end" id="date_end" value="{{ $coupon->date_end }}">
                            </div>
                            <div class="form-group">
                                <label for="discount_type">Discount Type</label>
                                <select name="discount_type" id="discount_type" class="form-control" disabled>

                                    @php
                                        $discountTypes = array(
                                            'amount' => array(
                                                'id' => 1,
                                                'value' => 'amount',
                                                'text' => 'Amount'
                                            ),
                                            'percent' => array(
                                                'id' => 2,
                                                'value' => 'percent',
                                                'text' => 'Percent'
                                            ), 'empty' => array(
                                                'id' => 3,
                                                'value' => '',
                                                'text' => ''
                                            )
                                        );
                                    @endphp
                                    @foreach ($discountTypes as $discountType)
                                         <option value="{{ $discountType['value'] }}" @if (old('discountType') == $coupon->discount_type || $coupon->discount_type == $discountType['value'] )selected @endif>{{ $discountType['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" class="form-control" name="discount" id="discount" min="0" value="{{ $coupon->discount }}">
                            </div>
                            <div class="form-group">
                                <label for="max_discount">Max Discount</label>
                                <input type="number" class="form-control" name="max_discount" id="max_discount" min="0" value="{{ $coupon->max_discount }}">
                            </div>
                            <div class="form-group">
                                <label for="min_purchase">Minimal Purchase</label>
                                <input type="number" class="form-control" name="min_purchase" id="min_purchase" min="0" value="{{ $coupon->min_purchase }}">
                            </div>
                            <div class="text-right mt-2">
                                <a href="{{ route('merchant.master-coupon') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
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
            }else{
                $('#discount_type').prop('disabled', false)
            }
        })
        const selectedCouponType = $('#coupon_type').val();

            if (selectedCouponType == 'free_delivery'){
                $('#discount_type').prop('disabled', true)
            }else{
                $('#discount_type').prop('disabled', false)
            }
    </script>
@endsection

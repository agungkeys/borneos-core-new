<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Order;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    public function getCoupon(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            if ($currentCoupon = Coupons::where('code', $request->slug)->doesntExist()) {
                return response()->json(['status' => 'error! coupon not available', 'data' => null], 404);
            } else {
                $currentCoupon = Coupons::where('code', $request->slug)->first();
                $totalOrderWithCoupon = Order::where('coupon_code', $request->slug)->count();

                if ($totalOrderWithCoupon <= $currentCoupon->limit_same_user) {
                    return response()->json(['status' => 'success', 'data' => $currentCoupon], 200);
                } else {
                    return response()->json(['status' => 'error! coupon out of stock', 'data' => null], 404);
                }
            }
        }
    }
}

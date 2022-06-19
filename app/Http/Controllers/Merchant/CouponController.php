<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    public function master_coupon_index(Request $request){
        $filter = $request->query('filter');
        $merchant = Merchant::where(['vendor_id' => Auth::guard('merchant')->user()->id])->first();
        if (!empty($filter)){
            $coupons = Coupons::sortable()
            ->where([['coupons.title', 'like', '%'. $filter . '%'], ['merchant_id', '=', $merchant->id ]])
            ->orWhere([['coupons.discount', 'like', '%' .$filter. '%'], ['merchant_id', '=', $merchant->id ]])
            ->paginate(10);
        } else {
            $coupons = Coupons::sortable()->where('merchant_id', $merchant->id)->paginate(10);
        }
        return view('merchant.coupon.index', compact('coupons', 'filter'));
    }

    public function master_coupon_status(Request $request){
        $coupon = Coupons::withoutGlobalScopes()->find($request->id);

        $coupon->status = $request->status;
        $coupon->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('merchant.master-coupon');
    }

    public function master_coupon_create(Request $request){

    }

    public function master_coupon_store(Request $request){

    }

    public function master_coupon_edit(Request $request, $id){

    }

    public function master_coupon_update(Request $request, $id){

    }

    public function master_coupon_delete($id){

    }
}

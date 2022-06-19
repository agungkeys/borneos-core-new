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
        return view('merchant.coupon.add');
    }

    public function master_coupon_store(Request $request){
        $merchant = Merchant::where(['vendor_id' => Auth::guard('merchant')->user()->id])->first();
        $request->validate([
            'title' => 'required',
            'coupon_type' => 'required',
            'merchant_id' => 'nullable',
            'code' => 'required',
            'date_start' => 'date|nullable',
            'date_end' => 'date|nullable',
            'limit_same_user' => 'nullable',
            'discount_type' => 'nullable',
            'max_discount' => 'nullable',
            'minimal_purchase' => 'nullable'
        ]);

        $coupon = new Coupons();

        $coupon->title = $request->title;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->merchant_id = $merchant->id;
        $coupon->code = $request->code;
        $coupon->limit_same_user = $request->limit_same_user;
        $coupon->date_start = $request->date_start;
        $coupon->date_end = $request->date_end;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->max_discount = $request->max_discount;
        $coupon->min_purchase = $request->min_purchase;
        $coupon->status = 1;

        $coupon->save();
        Alert::success('Success', 'Data saved succesfully!');
        return redirect()->route('merchant.master-coupon');
    }

    public function master_coupon_edit(Request $request, $id){
        $merchant = Merchant::where(['vendor_id' => Auth::guard('merchant')->user()->id])->first();
        $coupon = Coupons::where([['merchant_id', $merchant->id], ['id', $id]])->first();

        if ($coupon){
            return view('merchant.coupon.edit', [
                'coupon' => $coupon
            ]);
        }else{
            return abort(404);
        }
    }

    public function master_coupon_update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'coupon_type' => 'required',
            'merchant_id' => 'nullable',
            'code' => 'required',
            'date_start' => 'date|nullable',
            'date_end' => 'date|nullable',
            'limit_same_user' => 'nullable',
            'discount_type' => 'nullable',
            'max_discount' => 'nullable',
            'minimal_purchase' => 'nullable'
        ]);

        $coupon = Coupons::findOrFail($id);

        $coupon->title = $request->title;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->merchant_id = $coupon->merchant_id;
        $coupon->code = $request->code;
        $coupon->limit_same_user = $request->limit_same_user;
        $coupon->date_start = $request->date_start;
        $coupon->date_end = $request->date_end;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->max_discount = $request->max_discount;
        $coupon->min_purchase = $request->min_purchase;
        $coupon->status = $coupon->status;

        $coupon->save();
        Alert::success('Success', 'Data updated succesfully!');
        return redirect()->route('merchant.master-coupon');
    }

    public function master_coupon_delete($id){
        $coupon = Coupons::findOrFail($id);

        $coupon->delete();
        return response()->json(['status' => 200]);
    }
}

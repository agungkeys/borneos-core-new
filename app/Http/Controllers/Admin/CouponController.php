<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Merchant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)){
            $coupons = Coupons::sortable()
            ->where('coupons.title', 'like', '%'. $filter . '%')
            ->orWhere('coupons.discount', 'like', '%' .$filter. '%')
            ->paginate(10);
        } else {
            $coupons = Coupons::sortable()->paginate(10);
        }

        return view('admin.coupons.index', compact('coupons', 'filter'));
    }

    public function master_coupon_status(Request $request){
        $coupon = Coupons::withoutGlobalScopes()->find($request->id);

        $coupon->status = $request->status;
        $coupon->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchants = Merchant::all();
        return view('admin.coupons.add', [
            'merchants' => $merchants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $coupon->merchant_id = $request->merchant_id;
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
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupons::where('id', $id)->first();
        $merchants = Merchant::all();
        return view('admin.coupons.edit', [
            'coupon' => $coupon,
            'merchants' => $merchants
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        $coupon->merchant_id = $request->merchant_id;
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
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

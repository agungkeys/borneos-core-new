<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

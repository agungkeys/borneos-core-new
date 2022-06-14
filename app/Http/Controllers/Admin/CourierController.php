<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CourierController extends Controller
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
            $couriers = Courier::sortable()
            ->where('couriers.name', 'like', '%'. $filter . '%')
            ->orWhere('couriers.phone', 'like', '%' .$filter. '%')
            ->orWhere('couriers.identity_no', 'like', '%' .$filter. '%')
            ->paginate(10);
        } else {
            $couriers = Courier::sortable()->paginate(10);
        }

        return view('admin.couriers.index', compact('couriers', 'filter'));
    }

    public function master_courier_status(Request $request){
        $courier = Courier::withoutGlobalScopes()->find($request->id);

        $courier->status = $request->status;
        $courier->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.courier.index');
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

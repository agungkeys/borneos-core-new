<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function travel_index(Request $request)
    {
        //
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $travels = Travel::sortable()
                ->where('travel.id', 'like', '%' . $filter . '%')
                ->orWhere('travel.seat_no', 'like', '%' . $filter . '%')
                ->orWhere('travel.district', 'like', '%' . $filter . '%')
                ->orWhere('travel.sub_district', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $travels = Travel::sortable()->paginate(10);
        }
        return view('admin.travel.index', compact('travels', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function travel_create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function travel_store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function travel_show($id)
    {
        //
        $travel = Travel::findOrFail($id);
        return view('admin.travel.detail', compact('travel'));
    }

    public function travel_approved(Request $request, $id)
    {
        $travel = Travel::findOrFail($id);
        $travel->approved_at = date('Y-m-d H:i:s');
        $travel->save();
        Alert::success('Success', 'Approved Success');
        return redirect()->route('admin.travel.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function travel_edit($id)
    {
        //
        $travel = Travel::findOrFail($id);
        return view('admin.travel.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function travel_update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function travel_destroy($id)
    {
        //
    }
}

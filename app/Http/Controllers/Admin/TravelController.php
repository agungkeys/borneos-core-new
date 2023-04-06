<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Travels;
use App\Models\Travel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TravelController extends Controller
{
    use Travels;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function travel_index(Request $request)
    {
        //
        $travelsCount = (object)[
            'btgBpnPagi'  => Travel::where(['route' => 'BTG-BPN-PAGI'])->count(),
            'btnBpnMalam' => Travel::where(['route' => 'BTG-BPN-MALAM'])->count(),
            'btgSmdPagi'  => Travel::where(['route' => 'BTG-SMD-PAGI'])->count(),
            'smdBjmSiang' => Travel::where(['route' => 'SMD-BJM-SIANG'])->count(),
            'all'        => Travel::count()
        ];

        $filter = $request->query('filter');
        $route = $request->query('route');

        if (!empty($filter)) {
            if (!empty($route)) {
                $travels = Travel::sortable()
                    ->orWhere('fullname', 'like', '%' . $filter . '%')
                    ->where('route', '=', $route)
                    ->paginate(10);
            } else {
                $travels = Travel::sortable()
                    ->where('id', 'like', '%' . $filter . '%')
                    ->orWhere('fullname', 'like', '%' . $filter . '%')
                    // ->orWhere('route', '=', $route)
                    ->paginate(10);
            }
        } else {
            if (!empty($route)) {
                $travels = Travel::sortable()
                    ->where('route', '=', $route)
                    ->paginate(10);
            } else {
                $travels = Travel::sortable()->paginate(10);
            }
        }
        return view('admin.travel.index', compact('travels', 'filter', 'travelsCount', 'route'));
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
        // dd($request);

        $travel = Travel::find($id);

        $travel->update([
            'fullname' => $request->fullname,
            'telp' => $request->telp,
            'full_address' => $request->full_address,
            'sub_district' => $request->sub_district,
            'district' => $request->district,
            'route' => $request->routes,
            'seat_no' => $request->seat_no,
            'approved_at' => $request->approve ?  date('Y-m-d H:i:s') : null,
        ]);

        Alert::success('Updated', 'Updated Successfully');
        return redirect()->route('admin.travel.index');
    }

    public function travel_update_ktp(Request $request)
    {
        $travel = Travel::withoutGlobalScopes()->find($request->id);
        $travel->ktp = $request->ktp;
        $travel->save();
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.travel.index');
    }
    public function travel_update_kk(Request $request)
    {
        $travel = Travel::withoutGlobalScopes()->find($request->id);
        $travel->kk = $request->kk;
        $travel->save();
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.travel.index');
    }
    public function travel_update_vaccine(Request $request)
    {
        $travel = Travel::withoutGlobalScopes()->find($request->id);
        $travel->vaccine = $request->vaccine;
        $travel->save();
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.travel.index');
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

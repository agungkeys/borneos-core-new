<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Travels;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        $approval = $request->query('approval');

        if (!empty($filter)) {
            if (!empty($route)) {
                if ($approval === 'approved') {
                    $travels = Travel::sortable()
                        ->where('fullname', 'like', '%' . $filter . '%')
                        ->where('route', '=', $route)
                        ->whereNotNull('approved_at')
                        ->paginate(10);
                } else if ($approval === 'not-approved') {
                    $travels = Travel::sortable()
                        ->where('fullname', 'like', '%' . $filter . '%')
                        ->where('route', '=', $route)
                        ->whereNull('approved_at')
                        ->paginate(10);
                } else {
                    $travels = Travel::sortable()
                        ->where('fullname', 'like', '%' . $filter . '%')
                        ->where('route', '=', $route)
                        ->paginate(10);
                }
            } else {
                $travels = Travel::sortable()
                    ->where('id', 'like', '%' . $filter . '%')
                    ->orWhere('fullname', 'like', '%' . $filter . '%')
                    ->paginate(10);
            }
        } else if (!empty($route)) {
            if ($approval === 'approved') {
                $travels = Travel::sortable()
                    ->where('route', '=', $route)
                    ->whereNotNull('approved_at')
                    ->paginate(10);
            } else if ($approval === 'not-approved') {
                $travels = Travel::sortable()
                    ->where('route', '=', $route)
                    ->whereNull('approved_at')
                    ->paginate(10);
            } else {
                $travels = Travel::sortable()
                    ->where('route', '=', $route)
                    ->paginate(10);
            }
        } else if ($approval === 'approved') {
            $travels = Travel::sortable()
                ->whereNotNull('approved_at')
                ->paginate(10);
        } else if ($approval === 'not-approved') {
            $travels = Travel::sortable()
                ->whereNull('approved_at')
                ->paginate(10);
        } else {
            $travels = Travel::sortable()->paginate(10);
        }
        return view('admin.travel.index', compact('travels', 'filter', 'travelsCount', 'route', 'approval'));
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

    public function convertRoute($route)
    {
        switch ($route) {
            case 'BTG-BPN-MALAM':
                return 'Bontang - Balikpapan (Malam)';
                break;
            case 'BTG-BPN-PAGI':
                return 'Bontang - Balikpapan (Pagi)';
                break;
            case 'BTG-SMD-PAGI':
                return 'Bontang - Samarinda (Pagi)';
                break;
            case 'SMD-BJM-SIANG':
                return 'Samarinda - Banjarmasin (Siang)';
                break;
            default:
                return 'None';
                break;
        }
    }

    public function sendConfirmation(Request $request, $id)
    {
        $travel = Travel::findOrFail($id);
        $route = $this->convertRoute($travel->route);
        $telp = substr_replace($travel->telp, '62', 0, 1);
        $whatsAppUrl = 'https://wa.me/' . $telp . '/?text=Selamat%20*' . $travel->fullname . '*%20%2C%20%0A%0AAnda%20sudah%20terdaftar%20sebagai%20Calon%20Peserta%20Mudik%20Gratis%20bersama%20PKT%20dengan%20rute%20*' . $route . '*%20.%0A%0ASelanjutnya%20untuk%20Proses%20Verifikasi%2C%20silakan%20kirim%20*KTP%20dan%20KK*%20dalam%20bentuk%20Foto%20%2F%20PDF%20ke%20kami%20maksimal%20*10%20April%202023%20pukul%2016.00%20WITA*%20.%0A%0A*Jika%20nanti%20' . $travel->fullname . '%20Lolos%20verifikasi%2C%20maka%20akan%20kembali%20di%20hubungi%20dalam%20waktu%202x24%20Jam*%20.%0A%0AJika%20tidak%20mendapat%20pesan%20lanjutan%20artinya%20Anda%20belum%20lolos%20%26%20silakan%20mencoba%20lagi%20di%20tahun%20berikutnya%0A%0ASelamat%20Berpuasa%20%E2%98%BA%0A%0A*-%20Tim%20Mudik%20Gratis%20PKT%202023%20-*';

        return Redirect::to($whatsAppUrl);
    }

    public function sendTicket($id)
    {
        $travel = Travel::findOrFail($id);
        $route = $this->convertRoute($travel->route);
        $telp = substr_replace($travel->telp, '62', 0, 1);
        $whatsAppUrl = 'https://wa.me/' . $telp . '/?text=Halo%20' . $travel->fullname . '%2C%20berikut%20adalah%20link%20tiket%20untuk%20Mudik%20Gratis%20bersama%20PT.%20Pupuk%20Kaltim%20Tahun%202023%20Rute%20' . $route . '%0A%0Ahttps%3A%2F%2Fborneos.co%2Fmudik%2F' . $travel->prefix . '';

        return Redirect::to($whatsAppUrl);
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

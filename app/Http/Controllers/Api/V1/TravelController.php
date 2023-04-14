<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\Travels;
use App\Models\Travel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Traits\CloudinaryImage;

class TravelController extends Controller
{
    //

    use Travels;
    use CloudinaryImage;

    public function __construct()
    {
        $this->middleware('tokenb');
    }

    public function travel_store(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $travel = Travel::create([
                'prefix' => Str::random(5),
                'fullname' => $request->fullname ?? '',
                'telp' => $request->telp ?? '',
                'full_address' => $request->fullAddress ?? '',
                'sub_district' => $request->subDistrict ?? '',
                'district' => $request->district ?? '',
                'route' => $request->route ?? '',
                'id_card_no' => $request->idCardNo ?? '',
                'url_idcard' => $request->urlIdCard ?? '',
                'url_idvaccine' => $request->urlIdVaccine ?? '',
            ]);
            return response()->json(['status' => 'success', 'data' => $travel]);
        } else {
            return response()->json(['status' => 'error', 'data' => null]);
        }
    }

    public function get_travel_detail(Request $request, $slug)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            if (Travel::where('prefix', '=', $slug ?? '')->doesntExist()) {
                return response()->json(['status' => 'error', 'data' => null]);
            } else {
                $travel = Travel::where('prefix', '=', $slug)->get();
                return response()->json(['status' => 'success', 'data' => $this->resultTravelDetail($travel)]);
            }
        }
    }

    public function get_travel_route(Request $request)
    {

        if ($request->header('tokenb') === env('tokenb')) {

            // $btgBpnMorning = Travel::where('route', 'BTG-BPN-PAGI')->count();
            // // $btgBpnNight = Travel::where('route', 'BTG-BPN-MALAM')->count();
            // // $btgSmd = Travel::where('route', 'BTG-SMD-PAGI')->count();
            // // $smdBjm = Travel::where('route', 'SMD-BJM-SIANG')->count();

            // // dd($btgBpnMorning);

            $travelsCount = (object)[
                'btgBpnPagi'  => Travel::where(['route' => 'BTG-BPN-PAGI'])->count(),
                'btnBpnMalam' => Travel::where(['route' => 'BTG-BPN-MALAM'])->count(),
                'btgSmdPagi'  => Travel::where(['route' => 'BTG-SMD-PAGI'])->count(),
                'smdBjmSiang' => Travel::where(['route' => 'SMD-BJM-SIANG'])->count(),
            ];

            return response()->json(['status' => 'success', 'data' => $travelsCount]);

            // return response()->json([
            //     'status' => 'success', 'data' => [
            //         // 'btgBpnPagi' => 0,
            //         // 'btgBpnMalam' => 0,
            //         // 'btgSmdPagi' => 0,
            //         // 'smdBjmSiang' => 0,

            //         'btgBpnPagi' => $btgBpnMorning,
            //         // 'btgBpnMalam' => $btgBpnNight,
            //         // 'btgSmdPagi' => $btgSmd,
            //         // 'smdBjmSiang' => $smdBjm,
            //     ]
            // ]);
        }
    }
}

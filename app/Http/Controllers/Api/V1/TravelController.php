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
                'prefix' => Str::random(10),
                'fullname' => $request->fullname ?? '',
                'telp' => $request->telp ?? '',
                'full_address' => $request->fullAddress ?? '',
                'sub_district' => $request->subDistrict ?? '',
                'district' => $request->district ?? '',
                'route' => $request->route ?? '',
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
                $travel = Travel::where('prefix', '=', $slug)->get()[0];
                return response()->json(['status' => 'success', 'data' => $this->resultTravelDetail($travel)]);
            }
        }
    }
}

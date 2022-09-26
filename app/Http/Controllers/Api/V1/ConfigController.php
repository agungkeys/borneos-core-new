<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    public function distance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'originLat' => 'required',
            'originLng' => 'required',
            'destinationLat' => 'required',
            'destinationLng' => 'required',
        ]);
        if ($validator->errors()->count()>0) { 
            return response()->json(['errors' => $this->error_processor($validator)], 403);
        }
        $key = env('GOOGLE_MAPS_API_KEY');
        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$request['originLat'].','.$request['originLng'].'&destinations='.$request['destinationLat'].','.$request['destinationLng'].'&key='.$key);
        return $response->json();
    }
    public function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
}

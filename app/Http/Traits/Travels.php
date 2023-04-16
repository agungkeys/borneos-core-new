<?php

namespace App\Http\Traits;

use App\Models\Travel;

trait Travels
{
    public function store_travel()
    {
    }

    public function resultTravelDetail($travel)
    {
        return [
            'id' => $travel->id,
            'prefix' => $travel->prefix,
            'fullname' => $travel->fullname,
            'telp' => $travel->telp,
            'fullAddress' => $travel->full_address,
            'subDistrict' => $travel->sub_district,
            'district' => $travel->district,
            'route' => $travel->route,
            'seatNo' => $travel->seat_no,
            'ktp' => $travel->ktp,
            'kk' => $travel->kk,
            'vaccine' => $travel->vaccine,
            'urlIdCard' => $travel->url_idcard,
            'urlIdVaccine' => $travel->url_idvaccine,
            'idCardNo' => $travel->id_card_no,
            'approvedAt' => $travel->approved_at,
            'createdAt' => $travel->created_at,
            'updatedAt' => $travel->updated_at,
            'deletedAt' => $travel->deleted_at,
        ];
    }

    public function resultTravel($travel)
    {
        $travelDetail = Travel::all();
        if ($travelDetail->count() == 0) {
            $resultTravelDetail = null;
        } else {
            foreach ($travelDetail as $travel) {
                $results[] = [
                    'id' => $travel->id,
                    'prefix' => $travel->prefix,
                    'fullname' => $travel->fullname,
                    'telp' => $travel->telp,
                    'fullAddress' => $travel->full_address,
                    'subDistrict' => $travel->sub_district,
                    'district' => $travel->district,
                    'route' => $travel->route,
                    'seatNo' => $travel->seat_no,
                    'ktp' => $travel->ktp,
                    'kk' => $travel->kk,
                    'vaccine' => $travel->vaccine,
                    'urlIdCard' => $travel->url_idcard,
                    'urlIdVaccine' => $travel->url_idvaccine,
                    'approvedAt' => $travel->approved_at,
                    'createdAt' => $travel->created_at,
                    'updatedAt' => $travel->updated_at,
                    'deletedAt' => $travel->deleted_at,
                ];
            };
        }
        return $results;
    }

    public function FilterRoute($data)
    {
        $route = $data['route'];

        if ($route == null) {
            $travel = Travel::sortable()->paginate(10);
            return $travel;
        } else {
            $travel = Travel::sortable()->where('route', '=',  $route)->paginate(10);
            // dd($travel);
            return $travel;
        }
    }
}

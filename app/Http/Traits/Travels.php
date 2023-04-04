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
        $travelDetail = Travel::where('id', '=', $travel->id)->get();
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
                    'urlIdCard' => $travel->url_idcard,
                    'urlIdVaccine' => $travel->url_idvaccine,
                    'approvedAt' => $travel->approved_at ? $travel->approved_at->format('d/m/Y') : null,
                    'createdAt' => $travel->created_at->format('d/m/Y'),
                    'updatedAt' => $travel->updated_at->format('d/m/Y'),
                    'deletedAt' => $travel->deleted_at ?  $travel->deleted_at->format('d/m/Y') : null,
                ];
            };
        }
        return $results;
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
                    'urlIdCard' => $travel->url_idcard,
                    'urlIdVaccine' => $travel->url_idvaccine,
                    'approvedAt' => $travel->approved_at,
                    'createdAt' => $travel->created_at->format('d/m/Y'),
                    'updatedAt' => $travel->updated_at->format('d/m/Y'),
                    'updatedAt' => $travel->updated_at->format('d/m/Y'),
                ];
            };
        }
        return $results;
    }
}

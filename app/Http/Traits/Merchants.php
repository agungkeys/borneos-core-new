<?php

namespace App\Http\Traits;

trait Merchants
{
    public function get_merchant_list($results)
    {
        foreach ($results as $result) {
            $data[] = [
                'id' => $result->id,
                'category_id' => $result->category->name,
                'category_ids' => json_decode($result->category_ids),
                'categories_id' => $result->categories_id,
                'categories_ids' => json_decode($result->categories_ids),
                'name' => $result->name,
                'slug' => $result->slug,
                'phone' => $result->phone,
                'email' => $result->email,
                'logo' => $result->logo,
                'additional_image' => json_decode($result->additional_image),
                'address' => $result->address,
                'opening_time' => $result->opening_time,
                'closing_time' => $result->closeing_time,
                'status' => $result->status,
                'merchant_favorite' => $result->merchant_favorite,
                'vendor' => [
                    'id' => $result->vendor_id,
                    'name' => $result->vendor->VendorName(),
                    'phone' => $result->vendor->phone,
                    'email' => $result->vendor->email
                ],
                'cover_photo' => $result->cover_photo,
                'delivery' => $result->delivery,
                'take_away' => $result->take_away
            ];
        }
        return $data;
    }
}

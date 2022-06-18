<?php

namespace App\Http\Traits;

trait Merchants
{
    public function get_merchant_list($results)
    {
        foreach ($results as $result) {
            $data[] = [
                'id' => $result->id,
                'categoryId' => $result->category->name,
                'categoryIds' => json_decode($result->category_ids),
                'categoriesId' => $result->categories_id,
                'categoriesIds' => json_decode($result->categories_ids),
                'name' => $result->name,
                'slug' => $result->slug,
                'phone' => $result->phone,
                'email' => $result->email,
                'logo' => $result->logo,
                'additionalImage' => json_decode($result->additional_image),
                'address' => $result->address,
                'openingTime' => $result->opening_time,
                'closingTime' => $result->closeing_time,
                'status' => $result->status,
                'merchantFavorite' => $result->merchant_favorite,
                'vendor' => [
                    'id' => $result->vendor_id,
                    'name' => $result->vendor->VendorName(),
                    'phone' => $result->vendor->phone,
                    'email' => $result->vendor->email
                ],
                'coverPhoto' => $result->cover_photo,
                'delivery' => $result->delivery,
                'takeAway' => $result->take_away
            ];
        }
        return $data;
    }
}

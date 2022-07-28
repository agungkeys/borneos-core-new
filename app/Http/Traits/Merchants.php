<?php

namespace App\Http\Traits;

use App\Models\Product;

trait Merchants
{
    public function RestProductFavoriteFromMerchant($id)
    {
        $products = Product::where('merchant_id', $id)->where('favorite', 1)->get();
        $results = count($products) == 0 ? null : $products;
        if ($results == null) {
            return null;
        } else {
            foreach ($results as $result) {
                $data[] = [
                    'id'          => $result->id,
                    'merchant_id' => $result->merchant_id,
                    'name'        => $result->name,
                    'description' => $result->description,
                    'image'       => $result->image ? $result->image : null,
                    'additional_image' => $result->additional_image ? json_decode($result->additional_image) : null,
                    'available_time_starts' => substr($result->available_time_starts, 0, 5),
                    'available_time_ends'   => substr($result->available_time_ends, 0, 5),
                    'favorite' => $result->favorite,
                    'status'   => $result->status
                ];
            }
            return $data;
        }
    }
    public function RestTotalProductOnMerchant($id)
    {
        return Product::where('merchant_id', $id)->count();
    }
    public function get_merchant_list($results)
    {
        foreach ($results as $result) {
            $data[] = [
                'id' => $result->id,
                'categoryId' => $result->category_id ? $result->category->name : $result->category_id,
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
                'openingTime' => substr($result->opening_time, 0, 5),
                'closingTime' => substr($result->closeing_time, 0, 5),
                'status' => $result->status,
                'merchantFavorite' => $result->merchant_favorite,
                'productFavorite' => $this->RestProductFavoriteFromMerchant($result->id),
                'totalProductOnMerchant' => $this->RestTotalProductOnMerchant($result->id),
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

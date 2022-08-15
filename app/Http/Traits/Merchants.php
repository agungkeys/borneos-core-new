<?php

namespace App\Http\Traits;

use App\Models\{Merchant, Product};

trait Merchants
{
    public function SearchMerchantList($data)
    {
        $filter   = $data['filter'];
        $favorite = $data['favorite'];
        $status   = $data['status'];

        if ($filter == null) {
            if ($favorite == null) {
                if ($status == null) {
                    /* $filter null $favorite null $status null */
                    $master_merchants = Merchant::sortable()->paginate(10);
                    return ['filter' => null, 'favorite' => null, 'status' => null, 'master_merchants' => $master_merchants];
                } else {
                    /* $filter null $favorite null $status not null */
                    $master_merchants = Merchant::sortable()->where('merchants.status', 'like', '%' . $status . '%')->paginate(10);
                    return ['filter' => null, 'favorite' => null, 'status' => $status, 'master_merchants' => $master_merchants];
                }
            } else { /* filter null favorite not null */
                if ($status == null) {
                    /* filter null favorite not null status null */
                    $master_merchants = Merchant::sortable()->where('merchants.merchant_favorite', 'like', '%' . $favorite . '%')->paginate(10);
                    return ['filter' => null, 'favorite' => $favorite, 'status' => null, 'master_merchants' => $master_merchants];
                } else {
                    /* filter null favorite not null status not null */
                    $master_merchants = Merchant::sortable()
                        ->where('merchants.merchant_favorite', 'like', '%' . $favorite . '%')
                        ->where('merchants.status', 'like', '%' . $status . '%')
                        ->paginate(10);
                    return ['filter' => null, 'favorite' => $favorite, 'status' => $status, 'master_merchants' => $master_merchants];
                }
            }
        } else { /* filter not null */
            if ($favorite == null) {
                if ($status == null) {
                    /* filter not null favorite null status null */
                    $master_merchants = Merchant::sortable()
                        ->where('merchants.name', 'like', '%' . $filter . '%')
                        ->orWhere('merchants.phone', 'like', '%' . $filter . '%')
                        ->orWhereHas('vendor', function ($q) use ($filter) {
                            return $q->where('f_name', 'like', "%{$filter}%")->orWhere('l_name', 'like', "%{$filter}%");
                        })->paginate(10);
                    return ['filter' => $filter, 'favorite' => null, 'status' => null, 'master_merchants' => $master_merchants];
                } else {
                    /* filter not null favorite null status not null */
                    $master_merchants = Merchant::sortable()
                        ->where('merchants.status', 'like', '%' . $status . '%')
                        ->orWhere('merchants.name', 'like', '%' . $filter . '%')
                        ->orWhere('merchants.phone', 'like', '%' . $filter . '%')
                        ->orWhereHas('vendor', function ($q) use ($filter) {
                            return $q->where('f_name', 'like', "%{$filter}%")->orWhere('l_name', 'like', "%{$filter}%");
                        })->paginate(10);
                    return ['filter' => $filter, 'favorite' => null, 'status' => $status, 'master_merchants' => $master_merchants];
                }
            } else {
                /* filter not null favorite not null */
                if ($status == null) {
                    /* filter not null favorite not null status null */
                    $master_merchants = Merchant::sortable()
                        ->where('merchants.merchant_favorite', 'like', '%' . $favorite . '%')
                        ->orWhere('merchants.name', 'like', '%' . $filter . '%')
                        ->orWhere('merchants.phone', 'like', '%' . $filter . '%')
                        ->orWhereHas('vendor', function ($q) use ($filter) {
                            return $q->where('f_name', 'like', "%{$filter}%")->orWhere('l_name', 'like', "%{$filter}%");
                        })->paginate(10);
                    return ['filter' => $filter, 'favorite' => $favorite, 'status' => null, 'master_merchants' => $master_merchants];
                } else {
                    /* filter not null favorite not null status not null */
                    $master_merchants = Merchant::sortable()
                        ->where('merchants.merchant_favorite', 'like', '%' . $favorite . '%')
                        ->where('merchants.status', 'like', '%' . $status . '%')
                        ->orWhere('merchants.name', 'like', '%' . $filter . '%')
                        ->orWhere('merchants.phone', 'like', '%' . $filter . '%')
                        ->orWhereHas('vendor', function ($q) use ($filter) {
                            return $q->where('f_name', 'like', "%{$filter}%")->orWhere('l_name', 'like', "%{$filter}%");
                        })->paginate(10);
                    return ['filter' => $filter, 'favorite' => $favorite, 'status' => $status, 'master_merchants' => $master_merchants];
                }
            }
        }
    }

    public function discountPriceOnProduct($data)
    {
        /* payload: $data['price'] $data['discount_type'] $data['discount'] */
        if ($data['discount_type'] == null) {
            return null;
        } else {
            if ($data['discount'] == null) {
                return null;
            } else {
                if (ucfirst($data['discount_type']) == 'Amount') {
                    $price = $data['price'] - $data['discount'];
                    return $price <= 0 ? null : "$price";
                } else {
                    $price = ((int)$data['price'] / 100) * $data['discount'];
                    return $price <= 0 ? null : "$price";
                }
            }
        }
    }

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
                    'slug'        => $result->slug ? $result->slug : '',
                    'description' => $result->description,
                    'image'       => $result->image ? $result->image : null,
                    'additional_image' => $result->additional_image ? json_decode($result->additional_image) : null,
                    'available_time_starts' => substr($result->available_time_starts, 0, 5),
                    'available_time_ends'   => substr($result->available_time_ends, 0, 5),
                    'price'    => number_format($result->price, 0, ',', ''),
                    'discount' => number_format($result->discount, 0, ',', ''),
                    'discountType' => $result->discount_type,
                    'discountPrice' => $this->discountPriceOnProduct([
                        'discount' => $result->discount,
                        'discount_type' => $result->discount_type,
                        'price' => number_format($result->price, 0, ',', '')
                    ]),
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
                'district' => $result->district,
                'address' => $result->address,
                'openingTime' => substr($result->opening_time, 0, 5),
                'closingTime' => substr($result->closeing_time, 0, 5),
                'status' => $result->status,
                'merchantFavorite' => $result->merchant_favorite,
                'paidPartnership' => $result->paid_partnership,
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
    public function merchantListBySlug($result)
    {
        $data = [
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
            'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
            'district' => $result->district,
            'address' => $result->address,
            'openingTime' => substr($result->opening_time, 0, 5),
            'closingTime' => substr($result->closeing_time, 0, 5),
            'status' => $result->status,
            'merchantFavorite' => $result->merchant_favorite,
            'paidPartnership' => $result->paid_partnership,
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
        return $data;
    }
}

<?php

namespace App\Http\Traits;

use App\Models\Banner;

trait banners
{
    public function get_banners_list($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id'     => $result->id,
                'title'  => $result->title,
                'type'   => $result->type,
                'image'  => $result->image,
                'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                'url'    => $result->url,
                'status' => $result->status,
                'merchantId' => [
                    'id'   => $result->merchant_id,
                    'name' => $result->merchant_id && $result->merchant->name ? $result->merchant->name : null,
                    'slug' => $result->merchant_id && $result->merchant->slug ? $result->merchant->slug : null
                ],
                'adminId' => [
                    'id'     => $result->admin_id,
                    'name '  => $result->admin_id && $result->admin->f_name ? $result->admin->AdminName() : null,
                    'status' => $result->admin_id && $result->admin->role->status ? $result->admin->role->status : null
                ]
            ];
        };
        return $results;
    }

    public function QueryBannerList($data)
    {
        $type     = $data['type'];
        $merchant = $data['merchant'];
        $status   = $data['status'];
        $sort     = $data['sort'];

        if ($type && $merchant) {
            return Banner::whereHas('merchant', function ($q) use ($merchant) {
                return $q->where('id', '=', $merchant)->orWhere('slug', '=', $merchant);
            })
                ->where([['type', '=', $type], ['status', '=', $status]])
                ->orderBy('id', $sort)
                ->get();
        } elseif ($type) {
            return Banner::where([['type', '=', $type], ['status', '=', $status]])->orderBy('id', $sort)->get();
        } elseif ($merchant) {
            return Banner::whereHas('merchant', function ($q) use ($merchant) {
                return $q->where('id', '=', $merchant)->orWhere('slug', '=', $merchant);
            })
                ->where('status', '=', $status)
                ->orderBy('id', $sort)
                ->get();
        } else {
            return Banner::where('status', '=', $status)->orderBy('id', $sort)->get();
        }
    }
}

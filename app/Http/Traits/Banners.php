<?php

namespace App\Http\Traits;

use App\Models\Banner;

trait banners
{
    public function get_banners_list($banner)
    {
        if ($banner['type'] == null) {
            $banners = Banner::where(['status' => $banner['status']])->orderBy('id', $banner['sort'])->get();
            foreach ($banners as $banner) {
                $data[] = [
                    'id'     => $banner->id,
                    'title'  => $banner->title,
                    'type'   => $banner->type,
                    'image'  => $banner->image,
                    'url'    => $banner->url,
                    'status' => $banner->status,
                    'merchant_id' => [
                        'id'   => $banner->merchant_id,
                        'name' => $banner->merchant_id ? $banner->merchant->name : null
                    ],
                    'admin_id' => [
                        'id'     => $banner->admin_id,
                        'name '  => $banner->admin_id ? $banner->admin->f_name : null,
                        'status' => $banner->admin_id ? $banner->admin->status : null
                    ]
                ];
            };
            return $data;
        } elseif ($banner['type']) {
            $banners = Banner::where(['type' => $banner['type'], 'status' => $banner['status']])->orderBy('id', $banner['sort'])->get();
            foreach ($banners as $banner) {
                $data[] = [
                    'id'     => $banner->id,
                    'title'  => $banner->title,
                    'type'   => $banner->type,
                    'image'  => $banner->image,
                    'url'    => $banner->url,
                    'status' => $banner->status,
                    'merchant_id' => [
                        'id'   => $banner->merchant_id,
                        'name' => $banner->merchant_id ? $banner->merchant->name : null
                    ],
                    'admin_id' => [
                        'id'     => $banner->admin_id,
                        'name '  => $banner->admin_id ? $banner->admin->f_name : null,
                        'status' => $banner->admin_id ? $banner->admin->status : null
                    ]
                ];
            };
            return $data;
        };
    }
}

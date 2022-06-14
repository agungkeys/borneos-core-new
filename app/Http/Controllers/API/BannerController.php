<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function master_banner_index()
    {
        $banners = Banner::where(['status' => 1])->get();
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
        return response()->json($data, 200);
    }
}

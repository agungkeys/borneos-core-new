<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\{Banners, FormatMeta};

class BannerController extends Controller
{
    use Banners, FormatMeta;

    public function get_banners(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $status = $request->status ?? 1;
            $type  =  $request->type ?? null;
            $merchant = $request->merchant ?? null; //slug merchant or merchant id
            $sort  = $request->sort ?? 'desc';

            $banners = $this->QueryBannerList(compact('status', 'type', 'sort', 'merchant'));
            if ($banners->count() == 0) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } else {
                return response()->json(['status' => 'success', 'meta' => $this->MetaBanner(), 'data' => $this->get_banners_list($banners)]);
            }
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        };
    }
}

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
        if ($request->header('KEY_HEADER') === env('KEY_HEADER')) {
            $status = $request->status ?? null;
            $type  =  $request->type ?? null;
            $sort  = $request->sort ?? 'desc';
            if ($status == null) {
                return response()->json([
                    'status' => 'success',
                    'meta' => $this->MetaBanner(),
                    'data' => $this->get_banners_list(['status' => 1, 'type' => $type, 'sort' => $sort])
                ], 200);
            } elseif ($status == 1) {
                return response()->json([
                    'status' => 'success',
                    'meta' => $this->MetaBanner(),
                    'data' => $this->get_banners_list(compact('status', 'type', 'sort'))
                ], 200);
            }
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        };
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\{Categories, FormatMeta};

class CategoryController extends Controller
{
    use Categories, FormatMeta;

    public function get_categories(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $status = $request->status ?? null;
            $sort   = $request->sort ?? 'desc';
            if ($status == null) {
                return response()->json([
                    'status' => 'success',
                    'meta'   => $this->MetaCategory(),
                    'data'   => $this->getCategory(['status' => 1, 'sort' => $sort])
                ], 200);
            } elseif ($status == 1) {
                return response()->json([
                    'status' => 'success',
                    'meta'   => $this->MetaCategory(),
                    'data'   => $this->getCategory(compact('status', 'sort'))
                ], 200);
            };
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Categories, Merchants, FormatMeta};
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    use Categories, Merchants, FormatMeta;

    public function get_merchants(Request $request)
    {
        if ($request->header('KEY_HEADER') === env('KEY_HEADER')) {
            $status = $request->status ?? 1;
            $merchant_favorite = $request->merchant_favorite ?? 1;
            $category_id = $request->category ? $this->getCategoryId(['category' => $request->category]) : 0;
            $categories_id = $request->categories ? $this->getCategoryId(['category' => $request->categories]) : 0;
            $sort = $request->sort ?? 'desc';
            if ($category_id == 0) {
                if ($categories_id == 0) {
                    $query = Merchant::where('status', $status)
                        ->where('merchant_favorite', $merchant_favorite)
                        ->orderBy('id', $sort)
                        ->get();
                } elseif ($categories_id > 0) {
                    $query = Merchant::where('categories_id', 'like', "%{$categories_id}%")
                        ->where('status', $status)
                        ->where('merchant_favorite', $merchant_favorite)
                        ->orderBy('id', $sort)
                        ->get();
                }
            } elseif ($category_id > 0) {
                if ($categories_id > 0) {
                    $query = Merchant::where('category_id', $category_id)
                        ->where('categories_id', 'like', "%{$categories_id}%")
                        ->where('status', $status)
                        ->where('merchant_favorite', $merchant_favorite)
                        ->orderBy('id', $sort)
                        ->get();
                } elseif ($categories_id == 0) {
                    $query = Merchant::where('category_id', $category_id)
                        ->where('status', $status)
                        ->where('merchant_favorite', $merchant_favorite)
                        ->orderBy('id', $sort)
                        ->get();
                }
            }
            if ($query->count()) {
                $merchant = $this->get_merchant_list($query);
            } else {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            };
            $meta = $this->MetaMerchant([
                'merchant_count' => $query->count(),
                'category_id'    => $category_id,
                'categories_id'  => $categories_id
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $merchant]);
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }
}

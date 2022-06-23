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
        if ($request->header('tokenb') === env('tokenb')) {
            $status = $request->status ?? 1;
            $merchant_favorite = $request->merchantFavorite ?? null;
            $category_id = $request->category ? $this->getCategoryId(['category' => $request->category]) : 0;
            $categories_id = $request->categories ? $this->getCategoryId(['category' => $request->categories]) : 0;
            $perPage = $request->perPage ? $request->perPage : 10;
            $sort = $request->sort ?? 'desc';
            if ($category_id == 0) {
                if ($categories_id == 0) {
                    if ($merchant_favorite == null) {
                        $query = Merchant::where('status', $status)->orderBy('id', $sort)->paginate($perPage);
                    } elseif ($merchant_favorite !== null) {
                        $query = Merchant::where('status', $status)
                            ->where('merchant_favorite', $merchant_favorite)
                            ->orderBy('id', $sort)
                            ->paginate($perPage);
                    }
                } elseif ($categories_id > 0) {
                    if ($merchant_favorite == null) {
                        $query = Merchant::where('categories_id', 'like', "%{$categories_id}%")
                            ->where('status', $status)
                            ->orderBy('id', $sort)
                            ->paginate($perPage);
                    } elseif ($merchant_favorite !== null) {
                        $query = Merchant::where('categories_id', 'like', "%{$categories_id}%")
                            ->where('status', $status)
                            ->where('merchant_favorite', $merchant_favorite)
                            ->orderBy('id', $sort)
                            ->paginate($perPage);
                    }
                }
            } elseif ($category_id > 0) {
                if ($categories_id > 0) {
                    if ($merchant_favorite == null) {
                        $query = Merchant::where('category_id', $category_id)
                            ->where('categories_id', 'like', "%{$categories_id}%")
                            ->where('status', $status)
                            ->orderBy('id', $sort)
                            ->paginate($perPage);
                    } elseif ($merchant_favorite !== null) {
                        $query = Merchant::where('category_id', $category_id)
                            ->where('categories_id', 'like', "%{$categories_id}%")
                            ->where('status', $status)
                            ->where('merchant_favorite', $merchant_favorite)
                            ->orderBy('id', $sort)
                            ->paginate($perPage);
                    }
                } elseif ($categories_id == 0) {
                    if ($merchant_favorite == null) {
                        $query = Merchant::where('category_id', $category_id)
                            ->where('status', $status)
                            ->orderBy('id', $sort)
                            ->paginate($perPage);
                    } elseif ($merchant_favorite !== null) {
                        $query = Merchant::where('category_id', $category_id)
                            ->where('status', $status)
                            ->where('merchant_favorite', $merchant_favorite)
                            ->orderBy('id', $sort)
                            ->paginate($perPage);
                    }
                }
            }
            if ($query->count()) {
                $merchant = $this->get_merchant_list($query);
            } else {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            };
            $meta = $this->MetaMerchant([
                'page'           => $request->page == null ? null : $request->page,
                'perPage'        => $perPage,
                'merchant_count' => $query->total(),
                'category_id'    => $category_id,
                'categories_id'  => $categories_id
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $merchant]);
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }
    public function get_merchant_detail(Request $request, $slug)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $slug_id = $this->getCategorySlugPosition($slug);
            if ($slug_id !== null) {
                if ($slug_id['position'] == 0) {
                    $result = Merchant::where('category_id', $slug_id['id'])->get();
                    if ($result->count() == 0) {
                        return response()->json(['status' => 'error', 'data' => null]);
                    }
                } elseif ($slug_id['position'] > 0) {
                    $result = Merchant::where('categories_id', 'like', "%{$slug_id['id']}%")->get();
                    if ($result->count() == 0) {
                        return response()->json(['status' => 'error', 'data' => null]);
                    }
                }
                $merchant = $this->get_merchant_list($result);
                return response()->json(['status' => 'success', 'data' => $merchant]);
            } else {
                return response()->json(['status' => 'error', 'data' => null]);
            };
        } else {
            return response()->json(['status' => 'error', 'data' => null], 401);
        }
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Categories, Merchants, FormatMeta};
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    use Categories, Merchants, FormatMeta;

    public function __construct()
    {
        $this->middleware('tokenb');
    }

    public function get_merchant($slug)
    {
        $merchant = Merchant::where('slug', '=', $slug)->get()[0];
        if ($merchant->count() == 0) {
            return response()->json(['status' => 'error', 'data' => null]);
        } else {
            return response()->json(['status' => 'success', 'data' => $this->merchantListBySlug($merchant)]);
        }
    }
    public function get_merchants(Request $request)
    {
        /* Payload params */
        $status = $request->status ?? 1;
        $merchant_favorite = $request->merchantFavorite ?? null;
        $category_id = $request->category ? $this->getCategoryId(['category' => $request->category]) : 0;
        $categories_id = $request->subCategory ? $this->getCategoryIdPositionParentId($request->subCategory) : 0;
        $perPage = $request->perPage ? $request->perPage : 10;
        $sort = $request->sort ?? 'desc';
        $request_q = $request->q ?? '';
        $paid_partnership = $request->paidPartnership ?? '';

        if ($category_id == 0) {
            if ($categories_id == 0) {
                if ($merchant_favorite == null) {
                    $query = Merchant::where([
                        ['status', '=', $status],
                        ['name', 'like', '%' . $request_q . '%'],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
                        ->orderBy('id', $sort)
                        ->paginate($perPage);
                } else {
                    $query = Merchant::where([
                        ['status', '=', $status],
                        ['merchant_favorite', '=', $merchant_favorite],
                        ['name', 'like', '%' . $request_q . '%'],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
                        ->orderBy('id', $sort)
                        ->paginate($perPage);
                }
            } elseif ($categories_id !== 0) {
                if ($merchant_favorite == null) {
                    $query = Merchant::where([
                        ['categories_id', 'like', "%{$categories_id['id']}%"],
                        ['status', '=', $status],
                        ['name', 'like', "%{$request_q}%"],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
                        ->orderBy('id', $sort)
                        ->paginate($perPage);
                } else {
                    $query = Merchant::where([
                        ['categories_id', 'like', "%{$categories_id['id']}%"],
                        ['merchant_favorite', '=', $merchant_favorite],
                        ['status', '=', $status],
                        ['name', 'like', "%{$request_q}%"],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
                        ->orderBy('id', $sort)
                        ->paginate($perPage);
                }
            }
        } elseif ($category_id > 0) {
            if ($categories_id !== 0) {
                if ($merchant_favorite == null) {
                    $query = Merchant::where([
                        ['category_id', '=', $category_id],
                        ['categories_id', 'like', "%{$categories_id['id']}%"],
                        ['status', '=', $status],
                        ['name', 'like', "%{$request_q}%"],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
                        ->orderBy('id', $sort)
                        ->paginate($perPage);
                } else {
                    $query = Merchant::where([
                        ['category_id', '=', $category_id],
                        ['categories_id', 'like', "%{$categories_id['id']}%"],
                        ['status', '=', $status],
                        ['merchant_favorite', '=', $merchant_favorite],
                        ['name', 'like', '%' . $request_q . '%'],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
                        ->orderBy('id', $sort)
                        ->paginate($perPage);
                }
            } elseif ($categories_id == 0) {
                if ($merchant_favorite == null) {
                    $query = Merchant::where([
                        ['category_id', '=', $category_id],
                        ['status', '=', $status],
                        ['name', 'like', "%{$request_q}%"],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
                        ->orderBy('id', $sort)
                        ->paginate($perPage);
                } else {
                    $query = Merchant::where([
                        ['category_id', '=', $category_id],
                        ['merchant_favorite', '=', $merchant_favorite],
                        ['status', '=', $status],
                        ['name', 'like', "%{$request_q}%"],
                        ['paid_partnership', 'like', "%{$paid_partnership}%"],
                    ])
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
            'sub_category_id'  => $categories_id
        ]);
        return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $merchant]);
    }
    public function get_merchant_detail($slug)
    {
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
    }
    public function get_merchants_from_search(Request $request)
    {
        $request_q = $request->q ?? null; //merchant name
        $perPage = $request->perPage ?? 10;
        $query = $this->SearchMerchants(compact('request_q','perPage'));

        if($query->count() == 0){
            return response()->json(['status' => 'error','metaData' => (object)[],'data'=>null],404);
        } else {
            $meta = $this->MetaMerchantFromSearch([
                'page' => $request->page ?? null,
                'perPage' => $perPage,
                'total_merchants'=> $query->total()
            ]);
           return response()->json(['status' => 'success','metaData' => $meta,'data'=> $this->resultMerchantFromSearch($query)]);
        }
    }
}

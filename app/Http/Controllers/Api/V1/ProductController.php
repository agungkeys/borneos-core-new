<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Categories, Products, FormatMeta};
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Categories, Products, FormatMeta;

    public function get_products(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $status = $request->status ?? 1;
            $category = $request->category ? $this->getCategoryIdPositionParentId($request->category) : 0;
            $sub_category = $request->subCategory ? $this->getCategoryIdPositionParentId($request->subCategory) : 0;
            $sub_sub_category = $request->subSubCategory ? $this->getCategoryIdPositionParentId($request->subSubCategory) : 0;
            $sort = $request->sort ?? 'desc';
            $perPage = $request->perPage ? $request->perPage : 10;
            $merchant = $request->merchant ?? null;
            $product_favorite = $request->favorite ?? null;
            $product = $this->get_product_list(
                compact('status', 'category', 'sub_category', 'sub_sub_category', 'sort', 'perPage', 'merchant', 'product_favorite')
            );
            if ($product->count() == 0) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } else {
                $decision_category = $this->DesicionCategoryForListProduct(
                    compact('category', 'sub_category', 'sub_sub_category')
                );
                $meta = $this->MetaProduct([
                    'category' => $decision_category['category'],
                    'sub_category' => $decision_category['sub_category'],
                    'sub_sub_category' => $decision_category['sub_sub_category'],
                    'page' => $request->page == null ? null : $request->page,
                    'perPage' => $perPage,
                    'product_count' => $product->total()
                ]);
                return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->result_product_list($product)]);
            }
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }

    public function get_product_detail(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $slug = $request->slug ? $request->slug : '';
            $product = Product::where('slug', 'like', "%{$slug}%")->get();
            if ($product->count() == 0) {
                return response()->json(['status' => 'error', 'data' => null]);
            } else {
                return response()->json(['status' => 'success', 'data' => $this->result_product_list($product)]);
            }
        } else {
            return response()->json(['status' => 'error', 'data' => null], 401);
        }
    }
    public function get_product_list_merchant_landing(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            if (Merchant::where('slug', '=', $request->slug ?? 0)->doesntExist()) {
                return response()->json(['status' => 'error', 'data' => null]);
            } else {
                $merchant = Merchant::where('slug', '=', $request->slug)->get()[0];
                $product  = Product::where([['merchant_id', '=', $merchant->id], ['sub_category_id', '!=', null || 0]])->get();
                if ($product->count() == 0) {
                    return response()->json(['status' => 'error', 'data' => null]);
                } else {
                    return response()->json(['status' => 'success', 'data' => $this->productListMerchantLanding($merchant->id)]);
                }
            }
        } else {
            return response()->json(['status' => 'error', 'data' => null], 401);
        }
    }

    public function generate_slug_products()
    {
        return $this->GenerateSlugProduct();
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Categories, Products, FormatMeta};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Categories, Products, FormatMeta;

    public function get_products(Request $request)
    {
        if ($request->header('KEY_HEADER') === env('KEY_HEADER')) {
            $status = $request->status ?? 1;
            $category = $request->category ? $this->getCategoryIdPositionParentId($request->category) : 0;
            $sub_category = $request->sub_category ? $this->getCategoryIdPositionParentId($request->sub_category) : 0;
            $sub_sub_category = $request->sub_sub_category ? $this->getCategoryIdPositionParentId($request->sub_sub_category) : 0;
            $sort = $request->sort ?? 'desc';
            $product = $this->get_product_list(
                compact('status', 'category', 'sub_category', 'sub_sub_category', 'sort')
            );
            if ($product->count() == 0) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } elseif ($product->count() > 0) {
                $decision_category = $this->DesicionCategoryForListProduct(
                    compact('category', 'sub_category', 'sub_sub_category')
                );
                $meta = $this->MetaProduct([
                    'category' => $decision_category['category'],
                    'sub_category' => $decision_category['sub_category'],
                    'sub_sub_category' => $decision_category['sub_sub_category'],
                    'product_count' => $product->count()
                ]);
                return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->result_product_list($product)]);
            }
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }
}

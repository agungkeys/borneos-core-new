<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Cart, Categories, Products, FormatMeta};
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Categories, Products, FormatMeta, Cart;

    public function __construct()
    {
        $this->middleware('tokenb');
    }

    public function get_products(Request $request)
    {
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
    }

    public function get_product_detail(Request $request)
    {
        $slug = $request->slug ? $request->slug : '';
        $product = Product::where('slug', 'like', "%{$slug}%")->get();
        if ($product->count() == 0) {
            return response()->json(['status' => 'error', 'data' => null]);
        } else {
            return response()->json(['status' => 'success', 'data' => $this->result_product_detail($product)]);
        }
    }
    public function get_product_list_merchant_landing(Request $request)
    {
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
    }
    public function get_product_recomendation(Request $request)
    {
        $perPage  = $request->perPage ?? 6;
        $merchant = $request->merchant ?? 'null';
        $sort = $request->sort ?? 'desc';
        $favorite = $request->favorite ?? 'null';
        if ($merchant == 'null') {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            $product = $this->getProductRecomendation(compact('perPage', 'merchant', 'sort', 'favorite'));
            if ($product->count() == 0) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } else {
                $meta = $this->metaGetProductRecomendation([
                    'page' => $request->page == null ? 1 : $request->page,
                    'perPage' => $perPage,
                    'product_count' => $product->total(),
                    'sort' => $sort,
                    'merchant' => $merchant,
                    'favorite' => $favorite
                ]);
                return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->result_product_recomendation_list($product)]);
            }
        }
    }

    public function cart_validation(Request $request)
    {
        $merchantId = $request->merchantId ?? 'null';
        // $merchantSlug = $request->merchantSlug ?? 'null';
        $requestProducts = $request->products ?? 'null';

        if ($merchantId == 'null') {
            return response()->json(['status' => 'error', 'meta' => null, 'merchant' => null, 'products' => null]);
        } else {
            $merchant = Merchant::find($merchantId);
        }
        return response()->json([
            'status'   => 'success',
            'meta'     => (object)[],
            'merchant' => (object)[
                'id' => $merchant->id,
                'name' => $merchant->name,
                'slug' => $merchant->slug,
                'lat' => $merchant->latitude,
                'lng' => $merchant->longitude,
                'status' => $merchant->status,
                'logo' => $merchant->logo ? $merchant->logo : null,
                'coverPhoto' => $merchant->cover_photo ? $merchant->cover_photo : null,
                'additionalImage' => $merchant->additional_image ? json_decode($merchant->additional_image) : null,
                'merchantSpecial' => $merchant->merchant_special ? $merchant->merchant_special : '',
            ],
            'products' => $this->cartValidation($requestProducts)
        ]);
    }

    public function generate_slug_products()
    {
        return $this->GenerateSlugProduct();
    }
    public function search_product(Request $request)
    {
        $request_q = $request->q ?? null;
        $perPage = $request->perPage ?? 10;
        $sort = $request->sort ?? 'desc';
        $slugMerchant = $request->merchant ?? null;
        $query = $this->querySearchProduct(compact('request_q','perPage','sort','slugMerchant'));
      
        if(count($query['data']) == 0){
            return response()->json(['status' => 'error','meta' => (object)[],'data' => null]);
        } else {
            $meta = $this->MetaSearchProducts([
                'page' => $request->page ?? null,
                'perPage' => $perPage,
                'req' => ['request_q' => $request_q,'slugMerchant' => $slugMerchant],
                'totalData'=> $query['totalData']
            ]);
            return response()->json(['status'=>'success','meta' => $meta,'data'=> $query['data']]);
        }
    }
    public function get_products_from_search(Request $request)
    {
        $request_q = $request->q ?? null; //product name
        $perPage = $request->perPage ?? 10;
        $query = $this->SearchProducts(compact('request_q','perPage'));

        if($query->count() == 0){
            return response()->json(['status' => 'error','metaData'=>(object)[],'data'=>null],404);
        } else {
            $meta = $this->MetaProductFromSearch([
                'page' => $request->page ?? null,
                'perPage' => $perPage,
                'total_products'=> $query->total()
            ]);
            return response()->json(['status' => 'success','metaData' => $meta,'data'=>$this->resultProductFromSearch($query)]);
        }
    }
    
}

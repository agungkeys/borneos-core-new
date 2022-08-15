<?php

namespace App\Http\Traits;

use App\Models\Product;
use Illuminate\Support\Str;

trait Products
{
    use Merchants;

    public function SearchProductList($data)
    {
        $filter   = $data['filter'];
        $merchant = $data['merchant'];
        $favorite = $data['favorite'];
        $status   = $data['status'];

        if ($filter == null) {
            if ($merchant == null) { /* filter null merchant null */
                if ($favorite == null) { /* filter null merchant null favorite null */
                    if ($status == null) {
                        /* filter null merchant null favorite null status null */
                        $products = Product::sortable()->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter null merchant null favorite null status not null */
                        $products = Product::sortable()->where('products.status', 'like', '%' . $status . '%')->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                } else { /* filter null merchant null favorite not null */
                    if ($status == null) {
                        /* filter null merchant null favorite not null status null */
                        $products = Product::sortable()->where('products.favorite', '=', $favorite)->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter null merchant null favorite not null status not null */
                        $products = Product::sortable()
                            ->where('products.favorite', '=', $favorite)
                            ->where('products.status', '=', $status)
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                }
            } else { /* filter null merchant not null */
                if ($favorite == null) { /* filter null merchant not null favorite null */
                    if ($status == null) {
                        /* filter null merchant not null favorite null status null */
                        $products = Product::sortable()->where('products.merchant_id', '=', $merchant)->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter null merchant not null favorite null status not null */
                        $products = Product::sortable()->where('products.merchant_id', '=', $merchant)
                            ->where('products.status', '=', $status)
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                } else { /* filter null merchant not null favorite not null */
                    if ($status == null) {
                        /* filter null merchant not null favorite not null status null */
                        $products = Product::sortable()
                            ->where('products.merchant_id', '=', $merchant)
                            ->where('products.favorite', '=', $favorite)
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter null merchant not null favorite not null status not null */
                        $products = Product::sortable()
                            ->where('products.merchant_id', '=', $merchant)
                            ->where('products.favorite', '=', $favorite)
                            ->where('products.status', '=', $status)
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                }
            }
        } else { /* filter not null */
            if ($merchant == null) {
                if ($favorite == null) { /* filter not null merchant null favorite null */
                    if ($status == null) {
                        /* filter not null merchant null favorite null status null */
                        $products = Product::sortable()
                            ->where('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter not null merchant null favorite null status not null */
                        $products = Product::sortable()
                            ->where('products.status', '=', $status)
                            ->orWhere('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                } else { /* filter not null merchant null favorite not null */
                    if ($status == null) {
                        /* filter not null merchant null favorite not null status null */
                        $products = Product::sortable()
                            ->where('products.favorite', '=', $favorite)
                            ->orWhere('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter not null merchant null favorite not null status not null */
                        $products = Product::sortable()
                            ->where('products.favorite', '=', $favorite)
                            ->where('products.status', '=', $status)
                            ->orWhere('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                }
            } else { /* filter not null merchant not null */
                if ($favorite == null) {
                    if ($status == null) {
                        /* filter not null merchant not null favorite null status null */
                        $products = Product::sortable()
                            ->where('products.merchant_id', '=', $merchant)
                            ->orWhere('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter not null merchant not null favorite null status not null */
                        $products = Product::sortable()
                            ->where('products.merchant_id', '=', $merchant)
                            ->where('products.status', '=', $status)
                            ->orWhere('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                } else { /* filter not null merchant not null favorite not null */
                    if ($status == null) {
                        /* filter not null merchant not null favorite not null status null */
                        $products = Product::sortable()
                            ->where('products.merchant_id', '=', $merchant)
                            ->where('products.favorite', '=', $favorite)
                            ->orWhere('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    } else {
                        /* filter not null merchant not null favorite not null status not null */
                        $products = Product::sortable()
                            ->where('products.merchant_id', '=', $merchant)
                            ->where('products.favorite', '=', $favorite)
                            ->where('products.status', '=', $status)
                            ->orWhere('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', 'like', '%' . $filter . '%')
                            ->paginate(10);
                        return compact('filter', 'merchant', 'favorite', 'status', 'products');
                    }
                }
            }
        }
    }

    public function get_product_list($data)
    {
        if ($data['category'] == 0) {
            if ($data['sub_category'] == 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('status', $data['status'])
                        ->orderBy('id', $data['sort'])->paginate($data['perPage']);
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->paginate($data['perPage']);
                }
            } elseif ($data['sub_category'] !== 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('sub_category_id', $data['sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->paginate($data['perPage']);
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('sub_category_id', $data['sub_category'])
                        ->where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->paginate($data['perPage']);
                }
            }
        } elseif ($data['category'] !== 0) {
            if ($data['sub_category'] == 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->paginate($data['perPage']);
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->paginate($data['perPage']);
                }
            } elseif ($data['sub_category'] !== 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('sub_category_id', $data['sub_category'])
                        ->where('status', $data['status'])
                        ->orderBy('id', $data['sort'])->paginate($data['perPage']);
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('sub_category_id', $data['sub_category'])
                        ->where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])
                        ->orderBy('id', $data['sort'])->paginate($data['perPage']);
                }
            }
        }
    }
    public function result_product_list($data)
    {
        foreach ($data as $product) {
            $result[] = [
                'id' => $product->id,
                'merchantId' => [
                    'id' => $product->merchant->id,
                    'name' => $product->merchant->name,
                    'slug' => $product->merchant->slug
                ],
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
                'image' => $product->image,
                'additionalImage' => json_decode($product->additional_image),
                'categoryId' => [
                    'id' => $product->category_id,
                    'name' => $product->category_id ? $product->category->name : '',
                    'slug' => $product->category_id ? $product->category->slug : ''
                ],
                'subCategoryId' => [
                    'id' => $product->sub_category_id,
                    'name' => $product->sub_category_id ? $product->SubCategory->name : '',
                    'slug' => $product->sub_category_id ? $product->SubCategory->slug : ''
                ],
                'subSubCategoryId' => [
                    'id' => $product->sub_sub_category_id,
                    'name' => $product->sub_sub_category_id ? $product->SubSubCategory->name : '',
                    'slug' => $product->sub_sub_category_id ? $product->SubSubCategory->slug : ''
                ],
                'price' => number_format($product->price, 2, ",", "."),
                'taxType' => $product->tax_type,
                'discount' => $product->discount,
                'discountType' => $product->discount_type,
                'discountPrice' => $this->discountPriceOnProduct([
                    'discount' => $product->discount,
                    'discount_type' => $product->discount_type,
                    'price' => number_format($product->price, 0, ',', '')
                ]),
                'availableTimeStarts' => $product->available_time_starts,
                'availableTimeEnds' => $product->available_time_ends,
                'setMenu' => $product->set_menu,
                'status' => $product->status,
                'orderCount' => $product->order_count
            ];
        };
        return $result;
    }
    public function processGenerateSlug($data)
    {
        $slug = Str::slug($data);
        return str_replace(' ', '', Str::random(8) . "- $slug");
    }

    public function GenerateSlugProduct()
    {
        $products = Product::all();
        foreach ($products as $item) {
            Product::where(['id' => $item->id])->get()[0]->update(['slug' => $this->processGenerateSlug($item->name)]);
        }
        return response()->json(['status' => 'success']);
    }

    public function groupByFromSubCategoryId($data)
    {
        $query = Product::select('sub_category_id')
            ->where([['merchant_id', '=', $data], ['sub_category_id', '!=', null || 0]])
            ->groupBy('sub_category_id')
            ->get();
        return $query;
    }

    public function collectProductBySubCategoryId($data)
    {
        $query = Product::where([['merchant_id', '=', $data['merchant_id']], ['sub_category_id', '=', $data['sub_category_id']]])->limit(10)->get();
        if ($query->count() == 0) {
            return null;
        } else {
            foreach ($query as $item) {
                $result[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'description' => $item->description ?? null,
                    'price' => number_format($item->price, 0, ',', ''),
                    'priceDiscount' => $this->discountPriceOnProduct([
                        'discount' => $item->discount,
                        'discount_type' => $item->discount_type,
                        'price' => number_format($item->price, 0, ',', '')
                    ]),
                    'discountType' => $item->discount_type,
                    'discount' => $item->discount,
                    'image' => $item->image ? $item->image : null,
                    'additional_image' => $item->additional_image ? json_decode($item->additional_image) : null
                ];
            }
            return $result;
        }
    }

    public function productListMerchantLanding($data)
    {
        foreach ($this->groupByFromSubCategoryId($data) as $key => $item) {
            $result[] = [
                'id' => $key + 1,
                'subCategoryId'   => $item->sub_category_id,
                'subCategoryName' => $item->SubCategory->name ?? '',
                'subCategorySlug' => $item->SubCategory->slug ?? '',
                'product' => $this->collectProductBySubCategoryId(['merchant_id' => $data, 'sub_category_id' => $item->sub_category_id])
            ];
        };
        return $result;
    }
}

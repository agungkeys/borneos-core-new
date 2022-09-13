<?php

namespace App\Http\Traits;

use App\Models\Product;

trait Cart
{
    public function cartValidation($data)
    {
        if ($data == 'null') {
            return response()->json(['status' => 'error', 'meta' => null, 'merchant' => null, 'products' => null]);
        } else {
            foreach ($data as $item) {
                $results[] = [
                    'additionalImage'     => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'additionalImage']),
                    'availableTimeEnds'   => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'availableTimeEnds']),
                    'availableTimeStarts' => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'availableTimeStarts']),
                    'categoryId'          => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'categoryId']),
                    'description'         => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'description']),
                    'discount'            => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'discount']),
                    'discountPrice'       => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'discountPrice']),
                    'discountType'        => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'discountType']),
                    'id'                  => $item['id'],
                    'image'               => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'image']),
                    'itemTotal'           => $item['quantity'],
                    'merchantId'          => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'merchantId']),
                    'name'                => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'name']),
                    'orderCount'          => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'orderCount']),
                    'price'               => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'price']),
                    'quantity'            => $item['quantity'],
                    'setMenu'             => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'setMenu']),
                    'slug'                => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'slug']),
                    'status'              => (int)$this->refreshProductCart(['id' => $item['id'], 'refresh' => 'status']),
                    'subCategoryId'       => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'subCategoryId']),
                    'subSubCategoryId'    => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'subSubCategoryId']),
                    'taxType'             => $this->refreshProductCart(['id' => $item['id'], 'refresh' => 'taxType']),
                    'note'                => $item?['note'] || ''
                ];
            };
            return $results;
        }
    }
    public function refreshProductCart($data)
    {
        $product = Product::find($data['id']);
        switch ($data['refresh']) {
            case 'additionalImage':
                return $product->additional_image ? json_decode($product->additional_image) : null;
                break;
            case 'availableTimeEnds':
                return $product->available_time_ends;
                break;
            case 'availableTimeStarts':
                return $product->available_time_starts;
                break;
            case 'categoryId':
                return (object)[
                    'id'   => $product->category_id,
                    'name' => $product->category_id ? $product->category->name : null,
                    'slug' => $product->category_id ? $product->category->slug : null
                ];
                break;
            case 'description':
                return $product->description;
                break;
            case 'discount':
                return $product->discount;
                break;
            case 'discountPrice':
                return $this->discountPriceOnProduct([
                    'discount' => $product->discount,
                    'discount_type' => $product->discount_type,
                    'price' => number_format($product->price, 0, ',', '')
                ]);
                break;
            case 'discountType':
                return $product->discount_type;
                break;
            case 'image':
                return $product->image ? $product->image : null;
                break;
            case 'merchantId':
                return (object)[
                    'id'   => $product->merchant_id,
                    'name' => $product->merchant_id && $product->merchant->name ? $product->merchant->name : null,
                    'slug' => $product->merchant_id && $product->merchant->slug ? $product->merchant->slug : null
                ];
                break;
            case 'name':
                return $product->name;
                break;
            case 'orderCount':
                return $product->order_count;
                break;
            case 'price':
                return number_format($product->price, 0, "", "");
                break;
            case 'setMenu':
                return $product->set_menu;
                break;
            case 'slug':
                return $product->slug;
                break;
            case 'status':
                return $product->status;
                break;
            case 'subCategoryId':
                return (object)[
                    'id' => $product->sub_category_id ? $product->sub_category_id : null,
                    'name' => $product->sub_category_id && $product->SubCategory->name ? $product->SubCategory->name : null,
                    'slug' => $product->sub_category_id && $product->SubCategory->slug ? $product->SubCategory->slug : null
                ];
                break;
            case 'subSubCategoryId':
                return (object)[
                    'id' => $product->sub_sub_category_id ? $product->sub_sub_category_id : null,
                    'name' => $product->sub_sub_category_id && $product->SubSubCategory->name ? $product->SubSubCategory->name : null,
                    'slug' => $product->sub_sub_category_id && $product->SubSubCategory->slug ? $product->SubSubCategory->slug : null
                ];
                break;
            case 'taxType':
                return $product->tax_type;
                break;
        }
    }
}

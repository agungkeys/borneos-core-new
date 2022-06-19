<?php

namespace App\Http\Traits;

use App\Models\Product;

trait Products
{
    public function get_product_list($data)
    {
        if ($data['category'] == 0) {
            if ($data['sub_category'] == 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('status', $data['status'])
                        ->orderBy('id', $data['sort'])->get();
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->get();
                }
            } elseif ($data['sub_category'] !== 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('sub_category_id', $data['sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->get();
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('sub_category_id', $data['sub_category'])
                        ->where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->get();
                }
            }
        } elseif ($data['category'] !== 0) {
            if ($data['sub_category'] == 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->get();
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])->orderBy('id', $data['sort'])->get();
                }
            } elseif ($data['sub_category'] !== 0) {
                if ($data['sub_sub_category'] == 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('sub_category_id', $data['sub_category'])
                        ->where('status', $data['status'])
                        ->orderBy('id', $data['sort'])->get();
                } elseif ($data['sub_sub_category'] !== 0) {
                    return Product::where('category_id', $data['category'])
                        ->where('sub_category_id', $data['sub_category'])
                        ->where('sub_sub_category_id', $data['sub_sub_category'])
                        ->where('status', $data['status'])
                        ->orderBy('id', $data['sort'])->get();
                }
            }
        }
    }
    public function result_product_list($data)
    {
        foreach ($data as $product) {
            return [
                'id' => $product->id,
                'merchantId' => [
                    'id' => $product->merchant->id,
                    'name' => $product->merchant->name,
                    'slug' => $product->merchant->slug
                ],
                'name' => $product->name,
                'description' => $product->description,
                'image' => $product->image,
                'adiitionalImage' => json_decode($product->additional_image),
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
                'availableTimeStarts' => $product->available_time_starts,
                'availableTimeEnds' => $product->available_time_ends,
                'setMenu' => $product->set_menu,
                'status' => $product->status,
                'orderCount' => $product->order_count
            ];
        };
    }
}

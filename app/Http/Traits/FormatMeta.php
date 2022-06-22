<?php

namespace App\Http\Traits;

use App\Models\Category;

trait FormatMeta
{
    use Categories;

    public function MetaCategory()
    {
        return  [
            'status' => [
                [
                    'id' => 0,
                    'name' => 'In Active',
                    'value' => 0,
                ], [
                    'id' => 1,
                    'name' => 'Active',
                    'value' => 1,
                ]
            ],
            'sort' => [
                [
                    'id' => 'asc',
                    'label' => 'ASC',
                ], [
                    'id' => 'desc',
                    'label' => 'DESC'
                ]
            ],
        ];
    }
    public function MetaBanner()
    {
        return  [
            'type' => [
                [
                    'id' => 'restaurant_wise',
                    'name' => 'Restaurant Wise',
                    'value' => 'restaurant_wise',
                ], [
                    'id' => 'banner_merchant',
                    'name' => 'Banner Merchant',
                    'value' => 'banner_merchant',
                ]
            ],
            'status' => [
                [
                    'id' => 0,
                    'name' => 'In Active',
                    'value' => 0,
                ], [
                    'id' => 1,
                    'name' => 'Active',
                    'value' => 1,
                ]
            ],
        ];
    }
    public function MetaMerchant($data)
    {
        if ($data['category_id'] !== 0) {
            $merchant = Category::find($data['category_id']);
            $category = ['id' => $merchant->id, 'slug' => $merchant->slug, 'name' => $merchant->name];
        } elseif ($data['categories_id'] !== 0) {
            $merchant = Category::find($data['categories_id']);
            $categories = ['id' => $merchant->id, 'slug' => $merchant->slug, 'name' => $merchant->name];
        };
        return [
            'pagination' => [
                'page' => 1,
                'perPage' => 10,
                'total' => $data['merchant_count']
            ],
            'filter' => [
                'category' => $category ?? $this->DefaultMetacategory(),
                'categories' => $categories ?? [],
                'sort' => [
                    [
                        'id' => 'asc',
                        'label' => 'ASC'
                    ],
                    [
                        'id' => 'desc',
                        'label' => 'DESC'
                    ]
                ]
            ]
        ];
    }
    public function MetaProduct($data)
    {
        return [
            'pagination' => [
                'page' => 1,
                'perPage' => 10,
                'total' => $data['product_count']
            ],
            'filter' => [
                'category' => $data['category'],
                'subCategory' => $data['sub_category'],
                'subSubCategory' => $data['sub_sub_category'],
                'sort' => [
                    [
                        'id' => 'asc',
                        'label' => 'ASC'
                    ],
                    [
                        'id' => 'desc',
                        'label' => 'DESC'
                    ]
                ]
            ]
        ];
    }
    public function MetaOrderStore($data)
    {
        return [
            'message' => 'success',
            'orderId' => $data['order_id'],
            'prefix'  => $data['prefix'],
            'orderType' => $data['request']['orderType'],
            'merchantId' => $data['request']['merchantId'],
            'customerName' => $data['request']['customerName'],
            'customerTelp' => $data['request']['customerTelp'],
            'customerAddress' => $data['request']['customerAddress'],
            'customerAddressLat' => $data['request']['customerAddressLat'],
            'customerAddressLng' => $data['request']['customerAddressLng'],
            'customerNotes' => $data['request']['customerNotes'] ?? null,
            'distance' => $data['request']['distance'],
            'totalItem' => $data['request']['totalItem'],
            'totalItemPrice' => $data['request']['totalItemPrice'],
            'totalDistancePrice' => $data['request']['totalDistancePrice'],
            'totalPrice'    => $data['request']['totalPrice'],
            'paymentType'   => $data['request']['paymentType'],
            'paymentTotal'  => $data['request']['paymentTotal'],
            'status'        => 'new',
            'statusNotes'   => $data['request']['statusNotes'] ?? null,
            'createdAt'     => date('d/m/Y'),
            'updatedAt'     => date('d/m/Y')
        ];
    }
}

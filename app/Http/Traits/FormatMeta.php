<?php

namespace App\Http\Traits;

use App\Models\Category;
use App\Models\Merchant;

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
            if ($data['sub_category_id'] == 0) {
                $merchant = Category::find($data['category_id']);
                $category = [['id' => $merchant->id, 'slug' => $merchant->slug, 'name' => $merchant->name]];
                foreach (Category::where('parent_id', $merchant->id)->get() as $cat) {
                    $sub_category[] = ['id' => $cat->id, 'slug' => $cat->slug, 'name' => $cat->name];
                };
            } elseif ($data['sub_category_id'] !== 0) {
                $merchant = Category::find($data['category_id']);
                $category = [['id' => $merchant->id, 'slug' => $merchant->slug, 'name' => $merchant->name]];
                $sub_category = [['id' => $data['sub_category_id']['id'], 'slug' => $data['sub_category_id']['slug'], 'name' => $data['sub_category_id']['name']]];
            }
        } elseif ($data['category_id'] == 0) {
            if ($data['sub_category_id'] == 0) {
                foreach (Category::where(['position' => 0])->get() as $cat) {
                    $category[] = ['id' => $cat->id, 'slug' => $cat->slug, 'name' => $cat->name];
                }
                $sub_category = null;
            } elseif ($data['sub_category_id'] !== 0) {
                $categories = Category::find($data['sub_category_id']['parent_id']);
                $category = [['id' => $categories->id, 'slug' => $categories->slug, 'name' => $categories->name]];
                $sub_category = [['id' => $data['sub_category_id']['id'], 'slug' => $data['sub_category_id']['slug'], 'name' => $data['sub_category_id']['name']]];
            }
        }
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['merchant_count']
            ],
            'filter' => [
                'category' => $category,
                'subCategory' => $sub_category,
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
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
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
            'orderId' => $data->id,
            'prefix'  => $data->prefix,
            'orderType' => $data->order_type,
            'merchantId' => $data->merchant_id,
            'customerName' => $data->customer_name,
            'customerTelp' => $data->customer_telp,
            'customerAddress' => $data->customer_address,
            'customerAddressLat' => $data->customer_address_lat,
            'customerAddressLng' => $data->customer_address_lang,
            'customerNotes' => $data->customer_notes,
            'distance' => $data->distance,
            'totalItem' => $data->total_item,
            'totalItemPrice' => $data->total_item_price,
            'totalDistancePrice' => $data->total_distance_price,
            'totalPrice'    => $data->total_price,
            'paymentType'   => $data->payment_type,
            'paymentTotal'  => $data->payment_total,
            'paymentBankName' => $data->payment_bank_name,
            'paymentAccountNumber' => $data->payment_account_number,
            'paymentStatus' => $data->payment_status,
            'status'        => $data->status,
            'statusNotes'   => $data->status_notes,
            'createdAt'     => $data->created_at->format('d/m/Y'),
            'updatedAt'     => $data->updated_at->format('d/m/Y'),
        ];
    }
    public function metaGetProductRecomendation($data)
    {
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['product_count']
            ],
            'filter' => [
                'merchant' => $data['merchant'],
                'favorite' => $data['favorite'] == 'null' ? 'all' : (int)$data['favorite'],
                'sort' => $data['sort']

            ]
        ];
    }
    public function metaListBlogCategory($data)
    {
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['blogCategoryCount']
            ],
        ];
    }
    public function metaListBlog($data)
    {
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['blogCount']
            ],
        ];
    }

    public function MetaPaymentList($data)
    {
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['payment_count']
            ],
        ];
    }
    public function MetaListFAQ($data)
    {
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['faq_count']
            ],
        ];
    }
    public function MetaMerchantGroupList($data)
    {
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['merchantGroupCount']
            ],
        ];
    }
    public function MetaSearchProducts($data)
    {
        switch ($data) {
            case $data['req']['request_q'] && !$data['req']['slugMerchant']:
                //double
                return [
                    'paginationMerchants' => [
                        'page' => $data['page'] == null ? 1 : (int)$data['page'],
                        'perPage' => (int)$data['perPage'],
                        'total' => $data['totalData']['merchants']
                    ],
                    'paginationProducts' => [
                        'page' => $data['page'] == null ? 1 : (int)$data['page'],
                        'perPage' => (int)$data['perPage'],
                        'total' => $data['totalData']['products']
                    ]
                ];
                break;
            case $data['req']['slugMerchant'] && !$data['req']['request_q']:
                //one
                return [
                    'pagination' => [
                        'page' => $data['page'] == null ? 1 : (int)$data['page'],
                        'perPage' => (int)$data['perPage'],
                        'total' => $data['totalData']
                    ]
                ];
                break;
            case $data['req']['slugMerchant'] && $data['req']['request_q']:
                 //one
                return [
                    'pagination' => [
                        'page' => $data['page'] == null ? 1 : (int)$data['page'],
                        'perPage' => (int)$data['perPage'],
                        'total' => $data['totalData']
                    ]
                ];
                break;
            default:
                //double
                return [
                    'paginationMerchants' => [
                        'page' => $data['page'] == null ? 1 : (int)$data['page'],
                        'perPage' => (int)$data['perPage'],
                        'total' => $data['totalData']['merchants']
                    ],
                    'paginationProducts' => [
                        'page' => $data['page'] == null ? 1 : (int)$data['page'],
                        'perPage' => (int)$data['perPage'],
                        'total' => $data['totalData']['products']
                    ]
                ];
                break;
        }
    }
    public function MultiplePaginateFromSearchProducts($data)
    {
        return [
            'pagination' => [
                'page' => $data['page'] == null ? 1 : (int)$data['page'],
                'perPage' => (int)$data['perPage'],
                'total' => $data['productSearchCount']
            ],
        ];
    }
    public function MetaProductFromSearch($data)
    {
        return [
            'page' => $data['page'] == null ? 1 : (int)$data['page'],
            'perPage' => (int)$data['perPage'],
            'total' => $data['total_products']
        ];
    }
    public function MetaMerchantFromSearch($data)
    {
        return [
            'page' => $data['page'] == null ? 1 : (int)$data['page'],
            'perPage' => (int)$data['perPage'],
            'total' => $data['total_merchants']
        ];
    }
}

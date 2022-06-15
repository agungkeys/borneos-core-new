<?php

namespace App\Http\Traits;

trait FormatMeta
{
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
}

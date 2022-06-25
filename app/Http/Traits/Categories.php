<?php

namespace App\Http\Traits;

use App\Models\{Category, Merchant};

trait Categories
{
    public function getCategory($data)
    {
        $categories = Category::where(['position' => 0, 'status' => $data['status']])->orderBy('id', $data['sort'])->get();
        foreach ($categories as $c) {
            $category[] = [
                'id'    => $c->id,
                'name'  => $c->name,
                'slug'  => $c->slug,
                'image' => $c->image,
                'parent_id' => $c->parent_id,
                'position'  => $c->position,
                'status'    => $c->status,
                'priority'  => $c->priority,
                'additional_image' => json_decode($c->additional_image),
                'totalMerchant' => Merchant::where('category_id', '=', $c->id)->get('category_id')->count()
            ];
        }
        return $category;
    }
    public function getCategoryId($data)
    {
        $category = Category::where('name', '=', $data['category'])
            ->orWhere('slug', '=', $data['category'])
            ->get()[0];
        return $category->id;
    }
    public function getCategoryIdPositionParentId($data)
    {
        $query = Category::where('slug', $data)->get();
        if ($query->count() > 0) {
            return [
                'id' => $query[0]->id,
                'slug' => $query[0]->slug,
                'name' => $query[0]->name,
                'position' => $query[0]->position,
                'parent_id' => $query[0]->parent_id
            ];
        } elseif ($query->count() == 0) {
            return 0;
        }
    }
    public function getCategorySlugPosition($data)
    {
        $query = Category::where('slug', $data)->get();
        if ($query->count() > 0) {
            return ['id' => $query[0]->id, 'position' => $query[0]->position];
        }
        return null;
    }

    public function DesicionCategoryForListProduct($data)
    {
        if ($data['category'] == 0) {
            if ($data['sub_category'] == 0) {
                if ($data['sub_sub_category'] == 0) {
                    $query = Category::where('position', 0)->get();
                    foreach ($query as $c) {
                        $result[] = [
                            'id' => $c->id,
                            'slug' => $c->slug,
                            'name' => $c->name
                        ];
                    }
                    return ['category' => $result, 'sub_category' => [], 'sub_sub_category' => []];
                } elseif ($data['sub_sub_category'] !== 0) {
                    $sub_category = Category::where('id', $data['sub_sub_category']['parent_id'])->get();
                    $category = Category::where('id', $sub_category[0]->parent_id)->get();
                    return [
                        'category' => [
                            'id' => $category[0]->id,
                            'slug' => $category[0]->slug,
                            'name' => $category[0]->name
                        ],
                        'sub_category' => [
                            'id' => $sub_category[0]->id,
                            'slug' => $sub_category[0]->slug,
                            'name' => $sub_category[0]->name
                        ], 'sub_sub_category' => [
                            'id' => $data['sub_sub_category']['id'],
                            'slug' => $data['sub_sub_category']['slug'],
                            'name' => $data['sub_sub_category']['name']
                        ]
                    ];
                }
            } elseif ($data['sub_category'] !== 0) {
                if ($data['sub_sub_category'] == 0) {
                    $sub_categories = Category::where('parent_id', $data['sub_category']['id'])->get();
                    $category = Category::where('id', $data['sub_category']['parent_id'])->get();
                    foreach ($sub_categories as $sub_category) {
                        $result_sub_category[] = [
                            'id' => $sub_category->id,
                            'slug' => $sub_category->slug,
                            'name' => $sub_category->name
                        ];
                    }
                    return [
                        'category' => [
                            'id' => $category[0]->id,
                            'slug' => $category[0]->slug,
                            'name' => $category[0]->name
                        ],
                        'sub_category' => [
                            'id' => $data['sub_category']['id'],
                            'slug' => $data['sub_category']['slug'],
                            'name' => $data['sub_category']['name']
                        ], 'sub_sub_category' => $result_sub_category
                    ];
                } elseif ($data['sub_sub_category'] !== 0) {
                    $category = Category::where('id', $data['sub_category']['parent_id'])->get();
                    return [
                        'category' => [
                            'id' => $category[0]->id,
                            'slug' => $category[0]->slug,
                            'name' => $category[0]->name
                        ],
                        'sub_category' => [
                            'id' => $data['sub_category']['id'],
                            'slug' => $data['sub_category']['slug'],
                            'name' => $data['sub_category']['name']
                        ],
                        'sub_sub_category' => [
                            'id' => $data['sub_sub_category']['id'],
                            'slug' => $data['sub_sub_category']['slug'],
                            'name' => $data['sub_sub_category']['name']
                        ]
                    ];
                }
            }
        } elseif ($data['category'] !== 0) {
            if ($data['sub_category'] == 0) {
                if ($data['sub_sub_category'] == 0) {
                    $sub_categories = Category::where('position', 1)->where('parent_id', $data['category']['id'])->get();
                    foreach ($sub_categories as $sub_category) {
                        $result_sub_category[] = [
                            'id' => $sub_category->id,
                            'slug' => $sub_category->slug,
                            'name' => $sub_category->name
                        ];
                    }
                    return [
                        'category' => [
                            'id' => $data['category']['id'],
                            'slug' => $data['category']['slug'],
                            'name' => $data['category']['name']
                        ],
                        'sub_category' => $result_sub_category,
                        'sub_sub_category' => []
                    ];
                } elseif ($data['sub_sub_category'] !== 0) {
                    $sub_category = Category::where('id', $data['sub_sub_category']['parent_id'])->get();
                    return [
                        'category' => [
                            'id' => $data['category']['id'],
                            'slug' => $data['category']['slug'],
                            'name' => $data['category']['name']
                        ],
                        'sub_category' => [
                            'id' => $sub_category[0]->id,
                            'slug' => $sub_category[0]->slug,
                            'name' => $sub_category[0]->name
                        ],
                        'sub_sub_category' => [
                            'id' => $data['sub_sub_category']['id'],
                            'slug' => $data['sub_sub_category']['slug'],
                            'name' => $data['sub_sub_category']['name']
                        ]
                    ];
                }
            } elseif ($data['sub_category'] !== 0) {
                if ($data['sub_sub_category'] == 0) {
                    $sub_sub_categories = Category::where('parent_id', $data['sub_category']['id'])->get();
                    foreach ($sub_sub_categories as $sub_sub_category) {
                        $result_sub_category[] = [
                            'id' => $sub_sub_category->id,
                            'slug' => $sub_sub_category->slug,
                            'name' => $sub_sub_category->name
                        ];
                    }
                    return [
                        'category' => [
                            'id' => $data['category']['id'],
                            'slug' => $data['category']['slug'],
                            'name' => $data['category']['name']
                        ],
                        'sub_category' => [
                            'id' => $data['sub_category']['id'],
                            'slug' => $data['sub_category']['slug'],
                            'name' => $data['sub_category']['name']
                        ],
                        'sub_sub_category' => $result_sub_category
                    ];
                } elseif ($data['sub_sub_category'] !== 0) {
                    return [
                        'category' => [
                            'id' => $data['category']['id'],
                            'slug' => $data['category']['slug'],
                            'name' => $data['category']['name']
                        ],
                        'sub_category' => [
                            'id' => $data['sub_category']['id'],
                            'slug' => $data['sub_category']['slug'],
                            'name' => $data['sub_category']['name']
                        ],
                        'sub_sub_category' => [
                            'id' => $data['sub_sub_category']['id'],
                            'slug' => $data['sub_sub_category']['slug'],
                            'name' => $data['sub_sub_category']['name']
                        ]
                    ];
                }
            }
        }
    }
}

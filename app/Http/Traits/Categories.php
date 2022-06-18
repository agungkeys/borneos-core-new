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
    public function DefaultMetacategory()
    {
        foreach (Category::where(['position' => 0])->get() as $c) {
            $result[] = ['id' => $c->id, 'slug' => $c->slug, 'name' => $c->name];
        }
        return $result;
    }
}

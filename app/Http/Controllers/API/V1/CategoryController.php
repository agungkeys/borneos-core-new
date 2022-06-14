<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Merchant;

class CategoryController extends Controller
{
    public function get_categories()
    {
        try {
            $categories = Category::where(['position' => 0, 'status' => 1])->orderBy('priority', 'desc')->get();
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
            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}

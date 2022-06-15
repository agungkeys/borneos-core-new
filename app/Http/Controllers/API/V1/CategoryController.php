<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Merchant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_categories(Request $request)
    {
        try {
            if ($request->status == 1) {
                $categories = Category::where(['position' => 0, 'status' => $request->status])->orderBy('id', $request->sort)->get();
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
            };
            $meta = [
                'pagination' => (object)array(),
                'filter' => [
                    'status' => [
                        'id' => $request->status,
                        'label' => $request->status
                    ],
                    'sort' => [
                        'id'    => $request->sort,
                        'label' => strtoupper($request->sort)
                    ]
                ]
            ];
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $category ?? ''], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'data' => null], 200);
        }
    }
}

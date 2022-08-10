<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Merchant;

class UtilsController extends Controller
{
    public function get_merchants($id)
    {
        $merchant = Merchant::find($id);
        $category = Category::find($merchant->category_id);
        $sub_category = Category::where(['parent_id' => $category->id, 'position' => 1])->get(['id', 'name']);
        return response()->json([
            'category'       => $category->id,
            'category_name'  => $category->name,
            'sub_categories' => $sub_category,
            'open_time'      => $merchant->opening_time,
            'closing_time'   => $merchant->closeing_time
        ]);
    }
    public function get_sub_category($id)
    {
        $sub_category = Category::where(['parent_id' => $id, 'position' => 1])->get(['id', 'name']);
        return response()->json($sub_category);
    }

    public function get_sub_sub_category($id)
    {
        $sub_sub_category = Category::where(['parent_id' => $id])->get(['id', 'name']);
        return response()->json($sub_sub_category);
    }
}

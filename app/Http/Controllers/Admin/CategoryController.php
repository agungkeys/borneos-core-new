<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function master_category_index()
    {
        $master_categories = Category::where(['position' => 0])->get();
        return view('admin.categories.category.index', compact('master_categories'));
    }
}

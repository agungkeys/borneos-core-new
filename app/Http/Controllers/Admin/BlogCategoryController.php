<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function master_categoryBlog_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_category_blog = CategoryBlog::sortable()
                ->where('category_blog.name', 'like', '%' . $filter . '%')
                ->orWhere('category_blog.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_category_blog = CategoryBlog::sortable()->paginate(10);
        }
        return view('admin.blog-category.index', compact('master_category_blog', 'filter'));
    }
}

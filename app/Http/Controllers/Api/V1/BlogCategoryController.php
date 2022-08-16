<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{BlogCategory, FormatMeta};
use App\Models\CategoryBlog;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    use BlogCategory, FormatMeta;

    public function get_blog_categories(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $perPage = $request->perPage ?? 10;
            $blogCategory = CategoryBlog::paginate($perPage);
            if ($blogCategory->count() == 0) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } else {
                $meta = $this->metaListBlogCategory([
                    'page' => $request->page == null ? 1 : $request->page,
                    'perPage' => $perPage,
                    'blogCategoryCount' => $blogCategory->total(),
                ]);
                return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultBlogCategory($blogCategory)]);
            }
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }
}

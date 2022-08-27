<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\Blog as TraitsBlog;
use App\Http\Traits\FormatMeta;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use TraitsBlog, FormatMeta;

    public function get_blogs(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            $request_q = $request->q ?? null; // title blog
            $category = $request->category ?? null; // slug category-blog
            $sort = $request->sort ?? 'desc';
            $perPage = $request->perPage ?? 10;
            $blog = $this->queryBlogList(compact('request_q', 'category', 'sort', 'perPage'));

            if ($blog->count() == 0) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } else {
                $meta = $this->metaListBlog([
                    'page' => $request->page == null ? 1 : $request->page,
                    'perPage' => $perPage,
                    'blogCount' => $blog->total(),
                ]);
                return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultBlogList($blog)]);
            }
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }
}

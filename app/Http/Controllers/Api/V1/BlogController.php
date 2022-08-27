<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\Blog as TraitsBlog;
use App\Http\Traits\FormatMeta;
use App\Models\Blog;
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
    public function get_blog_detail(Request $request)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            if (Blog::where([['slug', '=', $request->slug ?? ''], ['status', '=', 1]])->doesntExist()) {
                return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
            } else {
                $blog = Blog::where([['slug', '=', $request->slug], ['status', '=', 1]])->get();
                return response()->json(['status' => 'success', 'meta' => (object)[], 'data' => $this->resultBlogDetail($blog)]);
            }
        } else {
            return response()->json(['status' => 'error', 'data' => null], 401);
        }
    }
}

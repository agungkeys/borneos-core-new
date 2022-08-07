<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    public function master_blog_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_blog = Blog::sortable()
                ->where('blog.title', 'like', '%' . $filter . '%')
                ->orWhere('blog.slug', 'like', '%' . $filter . '%')
                ->orWhere('blog.short_details', 'like', '%' . $filter . '%')
                ->orWhere('blog.details', 'like', '%' . $filter . '%')
                ->orWhereHas('blog_category', function ($q) use ($filter) {
                    return $q->where('name', 'like', "%{$filter}%");
                })
                ->orWhereHas('admin', function ($q) use ($filter) {
                    return $q->where('f_name', 'like', "%{$filter}%")->orWhere('l_name', 'like', "%{$filter}%");
                })
                ->paginate(10);
        } else {
            $master_blog = Blog::sortable()->paginate(10);
        }
        return view('admin.blog.index', compact('master_blog', 'filter'));
    }
    public function master_blog_status(Request $request)
    {
        $category = Blog::withoutGlobalScopes()->find($request->id);
        $category->status = $request->status;
        $category->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-blog');
    }
}

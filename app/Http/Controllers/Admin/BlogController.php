<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\{CloudinaryImage, Products};
use App\Models\{Blog, CategoryBlog};
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    use Products, CloudinaryImage;

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

    public function master_blog_add()
    {
        return view('admin.blog.add', [
            'categories' => CategoryBlog::all()
        ]);
    }
    public function master_blog_store(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'category' => 'required',
            'image'    => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/blogs/blog']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = '';
            $additional_image = '';
        };

        Blog::create([
            'blog_category_id' => $request->category,
            'user_id'          => auth()->guard('admin')->user()->id,
            'title'            => $request->title,
            'slug'             => $this->processGenerateSlug($request->title),
            'short_details'    => $request->short_details ?? '-',
            'details'          => $request->details ?? '-',
            'status'           => 1,
            'image'            => $image_url,
            'additional_image' => $additional_image
        ]);
        Alert::success('Success', 'Created Successfully');
        return redirect()->route('admin.blog.index');
    }
}

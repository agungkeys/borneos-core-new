<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\CategoryBlog;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogCategoryController extends Controller
{
    use CloudinaryImage;

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

    public function master_categoryBlog_add()
    {
        return view('admin.blog-category.add');
    }
    public function master_categoryBlog_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/blogs/blog-category']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = '';
            $additional_image = '';
        };

        CategoryBlog::create([
            'name'  => $request->category_name,
            'slug'  => $request->category_slug,
            'image' => $image_url,
            'additional_image' => $additional_image,
            'status' => 1
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.blog-category.index');
    }
    public function master_categoryBlog_edit(CategoryBlog $category)
    {
        return view('admin.blog-category.edit', compact('category'));
    }
    public function master_categoryBlog_update(Request $request, CategoryBlog $category)
    {
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'images/blogs/blog-category',
                'collection' => $category
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }
        $category->update([
            'name' => $request->category_name,
            'slug' => $request->category_slug,
            'image' => $image_url ?? $category->image,
            'additional_image' => $additional_image ?? $category->additional_image
        ]);
        Alert::success('Success', 'Data Updated Successfully');
        return redirect()->route('admin.blog-category.index');
    }
    public function master_categoryBlog_delete(CategoryBlog $category)
    {
        if ($category->image && $category->additional_image) {
            $key = json_decode($category->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $category->delete();
        return response()->json(['status' => 200]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    public function master_category_index()
    {
        $master_categories = Category::where(['position' => 0])->get();
        return view('admin.categories.category.index', compact('master_categories'));
    }
    public function master_category_add()
    {
        return view('admin.categories.category.add');
    }
    public function master_category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/categories", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url = $image->getSecurePath();
            $ext = substr($image_url, -3);
            $ext_jpeg = substr($image_url, -4);

            if ($ext == "jpg") {
                $image_url_webp = substr($image_url, 0, -3) . "webp";
            } else if ($ext == "png") {
                $image_url_webp = substr($image_url, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $image_url_webp = substr($image_url, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $image_url_webp = substr($image_url, 0, -4) . "webp";
            };

            $detail_image = [
                'public_id' =>  $image->getPublicId(),
                'file_type' =>  $image->getFileType(),
                'size'      =>  $image->getReadableSize(),
                'width'     =>  $image->getWidth(),
                'height'    =>  $image->getHeight(),
                'extension' =>  $image->getExtension(),
                'webp'      =>  $image_url_webp
            ];
            $additional_image = json_encode($detail_image);
        } else {
            $image_url = '';
            $additional_image = '';
        };
        $parent_id = Category::get('id')->max('id') + 1;
        Category::create([
            'name' => request('name'),
            'slug' => request('slug'),
            'image' => $image_url,
            'additional_image' => $additional_image,
            'parent_id' => $parent_id,
            'position'  => 0,
            'priority'  => 0,
            'status'    => 1
        ]);
        return redirect()->route('admin.master-category');
    }
}

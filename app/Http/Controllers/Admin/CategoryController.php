<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function master_category_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_categories = Category::sortable()
                ->where(['position' => 0])
                ->where('categories.name', 'like', '%' . $filter . '%')
                ->orWhere('categories.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_categories = Category::sortable()->where(['position' => 0])->paginate(10);
        }
        return view('admin.categories.category.index', compact('master_categories', 'filter'));
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
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.master-category');
    }

    public function master_category_edit($id)
    {
        return view('admin.categories.category.edit', [
            'master_category' => Category::find($id)
        ]);
    }

    public function master_category_update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'slug'  => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        $category = Category::findOrFail($id);
        if ($request->file('image')) {
            if ($category->image) {
                $key = json_decode($category->additional_image);
                Cloudinary::destroy($key->public_id);
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
            }
        } else {
            $image_url = $category->image;
            $additional_image = $category->additional_image;
        };
        $category->update([
            'name'              => request('name'),
            'slug'              => request('slug'),
            'image'             => $image_url,
            'position'          => $category->position,
            'additional_image'  => $additional_image
        ]);
        Alert::success('Updated', 'Data Updated Successfully');
        return redirect()->route('admin.master-category');
    }
    public function master_category_delete($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            $key = json_decode($category->additional_image);
            Cloudinary::destroy($key->public_id);
        };
        $category->delete();
        return response()->json(['status' => 200]);
    }
    public function master_category_status(Request $request)
    {
        $category = Category::withoutGlobalScopes()->find($request->id);
        $category->status = $request->status;
        $category->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-category');
    }

    public function master_sub_category_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_sub_categories = Category::sortable()
                ->where(['position' => 1])
                ->where('categories.name', 'like', '%' . $filter . '%')
                ->orWhere('categories.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_sub_categories = Category::sortable()->where(['position' => 1])->paginate(10);
        }
        return view('admin.categories.sub-category.index', compact('master_sub_categories', 'filter'));
    }
    public function master_sub_category_add()
    {
        $master_categories = Category::where(['position' => 0])->get();
        return view('admin.categories.sub-category.add', compact('master_categories'));
    }
    public function master_sub_category_store(Request $request)
    {
        $request->validate([
            'category'          => 'required',
            'sub-category-name' => 'required',
            'sub-category-slug' => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,svg|max:8192'
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
        Category::create([
            'name' => request('sub-category-name'),
            'slug' => request('sub-category-slug'),
            'image' => $image_url,
            'additional_image' => $additional_image,
            'parent_id' => request('category'),
            'position'  => 1,
            'priority'  => 0,
            'status'    => 1
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.master-sub-category');
    }
    public function master_sub_category_edit($id)
    {
        return view('admin.categories.sub-category.edit', [
            'sub_category'      => Category::find($id),
            'master_categories' => Category::where(['position' => 0])->get()
        ]);
    }
    public function master_sub_category_update(Request $request, $id)
    {
        $request->validate([
            'category'          => 'required',
            'sub-category-name' => 'required',
            'sub-category-slug' => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        $category = Category::findOrFail($id);
        if ($request->file('image')) {
            if ($category->image) {
                $key = json_decode($category->additional_image);
                Cloudinary::destroy($key->public_id);
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
            }
        } else {
            $image_url = $category->image;
            $additional_image = $category->additional_image;
        };
        $category->update([
            'name' => request('sub-category-name'),
            'slug' => request('sub-category-slug'),
            'image' => $image_url,
            'additional_image' => $additional_image,
            'parent_id' => request('category')
        ]);
        Alert::success('Updated', 'Data Updated Successfully');
        return redirect()->route('admin.master-sub-category');
    }
    public function master_sub_category_delete($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            $key = json_decode($category->additional_image);
            Cloudinary::destroy($key->public_id);
        };
        $category->delete();
        return response()->json(['status' => 200]);
    }
    public function master_sub_category_status(Request $request)
    {
        $category = Category::withoutGlobalScopes()->find($request->id);
        $category->status = $request->status;
        $category->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-sub-category');
    }
    public function master_sub_sub_category_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_sub_sub_categories = Category::sortable()
                ->where(['position' => 2])
                ->where('categories.name', 'like', '%' . $filter . '%')
                ->orWhere('categories.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_sub_sub_categories = Category::sortable()->where(['position' => 2])->paginate(10);
        }
        return view('admin.categories.sub-sub-category.index', compact('master_sub_sub_categories', 'filter'));
    }
    public function master_sub_sub_category_add()
    {
        return view('admin.categories.sub-sub-category.add', [
            'master_sub_categories' => Category::where(['position' => 1])->get()
        ]);
    }
    public function master_sub_sub_category_store(Request $request)
    {
        $request->validate([
            'sub-category'          => 'required',
            'sub-sub-category-name' => 'required',
            'sub-sub-category-slug' => 'required',
            'image'                 => 'image|mimes:jpeg,png,jpg,svg|max:8192'
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
        Category::create([
            'name' => request('sub-sub-category-name'),
            'slug' => request('sub-sub-category-slug'),
            'image' => $image_url,
            'additional_image' => $additional_image,
            'parent_id' => request('sub-category'),
            'position'  => 2,
            'priority'  => 0,
            'status'    => 1
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.master-sub-sub-category');
    }
    public function master_sub_sub_category_edit($id)
    {
        return view('admin.categories.sub-sub-category.edit', [
            'sub_sub_category' => Category::find($id),
            'sub_categories'   => Category::where(['position' => 1])->get()
        ]);
    }
    public function master_sub_sub_category_update(Request $request, $id)
    {
        $request->validate([
            'sub-category'          => 'required',
            'sub-sub-category-name' => 'required',
            'sub-sub-category-slug' => 'required',
            'image'                 => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        $category = Category::findOrFail($id);
        if ($request->file('image')) {
            if ($category->image) {
                $key = json_decode($category->additional_image);
                Cloudinary::destroy($key->public_id);
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
            }
        } else {
            $image_url = $category->image;
            $additional_image = $category->additional_image;
        };
        $category->update([
            'name' => request('sub-sub-category-name'),
            'slug' => request('sub-sub-category-slug'),
            'image' => $image_url,
            'additional_image' => $additional_image,
            'parent_id' => request('sub-category')
        ]);
        Alert::success('Updated', 'Data Updated Successfully');
        return redirect()->route('admin.master-sub-sub-category');
    }
    public function master_sub_sub_category_delete($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            $key = json_decode($category->additional_image);
            Cloudinary::destroy($key->public_id);
        };
        $category->delete();
        return response()->json(['status' => 200]);
    }
    public function master_sub_sub_category_status(Request $request)
    {
        $category = Category::withoutGlobalScopes()->find($request->id);
        $category->status = $request->status;
        $category->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-sub-sub-category');
    }
}

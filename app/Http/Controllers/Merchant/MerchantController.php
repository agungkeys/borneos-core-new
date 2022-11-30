<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class MerchantController extends Controller
{
    public function master_merchant_edit()
    {
        $master_merchant = Merchant::where(['vendor_id' => Auth()->id()])->first();
        return view('merchant.merchant.edit', [
            'master_merchant' => Merchant::find($master_merchant->id),
            'master_merchant_vendor' => Vendor::where('id', $master_merchant->vendor_id)->first(),
            'categories_position_0' => Category::where([['position','=',0],['status','=',1]])->get(),
            'categories_position_1' => Category::where([['position','=',1],['parent_id','=',$master_merchant->category_id],['status','=',1]])->get()
        ]);
    }

    public function master_merchant_update(Request $request, $id)
    {
        $master_merchant=Merchant::find($id);
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:merchants,slug,'. $id,
            'district' => 'required',
            'main_category_id' => 'required',
            'categories_id' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'email' => 'required|unique:vendors,email,' . $master_merchant->vendor_id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:vendors,phone,' . $master_merchant->vendor_id,
            'password' => 'nullable|min:6',
            'confirmPassword' => 'nullable|min:6',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:8192',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:8192',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:8192',
            'tax' => 'required',
        ], [
            'f_name.required' => 'First name is required!',
            'name.required' => 'Restaurant name is required!'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->file('logo')) {
            if ($master_merchant->logo) {
                $key = json_decode($master_merchant->additional_image);
                Cloudinary::destroy($key->logo->public_id);
                $path_name = $request->file('logo')->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => "images/merchants/logo", "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url_logo = $image->getSecurePath();
                $ext = substr($image_url_logo, -3);
                $ext_jpeg = substr($image_url_logo, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url_logo, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url_logo, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url_logo, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url_logo, 0, -4) . "webp";
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
                $additional_image_logo = $detail_image;
            } else {
                $path_name = $request->file('logo')->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => "images/merchants/logo", "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url_logo = $image->getSecurePath();
                $ext = substr($image_url_logo, -3);
                $ext_jpeg = substr($image_url_logo, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url_logo, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url_logo, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url_logo, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url_logo, 0, -4) . "webp";
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
                $additional_image_logo = $detail_image;
            }
        } else {
            $key = json_decode($master_merchant->additional_image);
            $additional_image_logo = $key->logo;
            $image_url_logo = $master_merchant->logo;
        };

        if ($request->file('cover_photo')) {
            if ($master_merchant->cover_photo) {
                $key = json_decode($master_merchant->additional_image);
                Cloudinary::destroy($key->cover->public_id);
                $path_name = $request->file('cover_photo')->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => "images/merchants/cover", "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url_cover = $image->getSecurePath();
                $ext = substr($image_url_cover, -3);
                $ext_jpeg = substr($image_url_cover, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url_cover, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url_cover, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url_cover, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url_cover, 0, -4) . "webp";
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
                $additional_image_cover = $detail_image;
            } else {
                $path_name = $request->file('cover_photo')->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => "images/merchants/cover", "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url_cover = $image->getSecurePath();
                $ext = substr($image_url_cover, -3);
                $ext_jpeg = substr($image_url_cover, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url_cover, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url_cover, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url_cover, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url_cover, 0, -4) . "webp";
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
                $additional_image_cover = $detail_image;
            }
        } else {
            $key = json_decode($master_merchant->additional_image);
            $additional_image_cover = $key->cover;
            $image_url_cover = $master_merchant->cover_photo;
        };

          if ($request->file('seo_image')) {
            if ($master_merchant->seo_image) {
                $key = json_decode($master_merchant->additional_seo_image);
                Cloudinary::destroy($key->public_id);
                $path_name = $request->file('seo_image')->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => "images/merchants/seo", "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url_seo = $image->getSecurePath();
                $ext = substr($image_url_seo, -3);
                $ext_jpeg = substr($image_url_seo, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url_seo, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url_seo, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url_seo, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url_seo, 0, -4) . "webp";
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
                $additional_seo_image = json_encode($detail_image);
            } else {
                $path_name = $request->file('seo_image')->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => "images/merchants/seo", "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url_seo = $image->getSecurePath();
                $ext = substr($image_url_seo, -3);
                $ext_jpeg = substr($image_url_seo, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url_seo, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url_seo, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url_seo, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url_seo, 0, -4) . "webp";
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
                $additional_seo_image = json_encode($detail_image);
            }
        } else {
            $additional_seo_image = $master_merchant->additional_seo_image;
            $image_url_seo = $master_merchant->seo_image;
        };

        $additional_image = [
            'logo'  => $additional_image_logo,
            'cover' => $additional_image_cover,
        ];
        $additional_image_json = json_encode($additional_image);

        $vendor = Vendor::findOrFail($master_merchant->vendor_id);
        $vendor->f_name = $request->f_name;
        $vendor->l_name = $request->l_name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->password = strlen($request->password) > 1 ? bcrypt($request->password) : $vendor->password;
        $vendor->save();

        $category_ids = Category::find($request->main_category_id);
        $json_category_ids = json_encode(['id' => $category_ids->id, 'slug' => $category_ids->slug]);
        $categories_id = implode(',', $request->categories_id);
        $categories = Category::whereIn('id', $request->categories_id)->get();
        if ($categories->count() == 1) {
            $categories_ids = ['id' => $categories[0]->id, 'name' => $categories[0]->name, 'slug' => $categories[0]->slug];
        } elseif ($categories->count() > 1) {
            foreach ($categories as $category) {
                $categories_ids[] = ['id' => $category->id, 'name' => $category->name, 'slug' => $category->slug];
            }
        }

        $json_categories_ids = json_encode($categories_ids);

        $master_merchant->update([
            'category_id'           => $request->main_category_id,
            'category_ids'          => $json_category_ids,
            'categories_id'         => $categories_id,
            'categories_ids'        => $json_categories_ids,
            'name'                  => $request->name,
            'slug'                  => $request->slug,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
            'logo'                  => $image_url_logo,
            'additional_image'      => $additional_image_json,
            'latitude'              => $request->latitude,
            'longitude'             => $request->longitude,
            'district'              => $request->district,
            'address'               => $request->address,
            'cover_photo'           => $image_url_cover,
            'tax'                   => $request->tax,
            'seo_image'             => $image_url_seo,
            'additional_seo_image'  => $additional_seo_image,
            'merchant_special'      => $request->merchant_special ?? ''
        ]);

        Alert::success('Updated', 'Data Updated Successfully');
        return redirect()->route('merchant.master-merchant.edit');
    }

    public function master_merchant_status(Request $request)
    {
        $master_merchant = Merchant::withoutGlobalScopes()->find($request->id);
        $master_merchant->active = $request->active;
        $master_merchant->save();

        Alert::toast('Status Updated', 'success');
        return redirect()->route('merchant.master-merchant.edit');
    }
}
?>

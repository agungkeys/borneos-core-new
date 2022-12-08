<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Merchants;
use App\Models\{Category,Merchant,MerchantGroup,Vendor};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MerchantController extends Controller
{
    use Merchants;

    public function master_merchant_index(Request $request)
    {
        $search = $this->SearchMerchantList([
            'filter'   => $request->query('filter'),
            'favorite' => $request->query('favorite'),
            'status'   => $request->query('status')
        ]);
        return view('admin.merchant.index', [
            'filter'   => $search['filter'],
            'favorite' => $search['favorite'] == null ? '' : $search['favorite'],
            'status'   => $search['status'] == null ? '' : $search['status'],
            'master_merchants' => $search['master_merchants']
        ]);
    }
    public function master_merchant_add()
    {
        $main_categories = Category::where([['position','=',0],['status','=',1]])->get();
        $merchant_groups = MerchantGroup::get();
        return view('admin.merchant.add', compact('main_categories','merchant_groups'));
    }
    public function master_merchant_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'district' => 'required',
            'main_category_id' => 'required',
            'categories_id' => 'required',
            'address' => 'required',
            'merchant_special' => 'sometimes',
            'latitude' => 'required',
            'longitude' => 'required',
            'email' => 'required|unique:vendors',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:vendors',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
            'cover_photo' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'seo_image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'tax' => 'required',
        ], [
            'f_name.required' => 'The first name field is required.'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

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

        $vendor = new Vendor();
        $vendor->f_name = $request->f_name;
        $vendor->l_name = $request->l_name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->password = bcrypt($request->password);
        $vendor->status = 1;
        $vendor->save();

        if ($request->file('logo')) {
            $path_name = $request->file('logo')->getRealPath();
            $image_logo = Cloudinary::upload($path_name, ["folder" => "images/merchants/logo", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url_logo = $image_logo->getSecurePath();
            $detail_image_logo = [
                'public_id' =>  $image_logo->getPublicId(),
                'file_type' =>  $image_logo->getFileType(),
                'size'      =>  $image_logo->getReadableSize(),
                'width'     =>  $image_logo->getWidth(),
                'height'    =>  $image_logo->getHeight(),
                'extension' =>  $image_logo->getExtension(),
            ];
            $additional_image_logo = $detail_image_logo;
        } else {
            $image_url_logo = '';
            $additional_image_logo = '';
        };

        if ($request->file('cover_photo')) {
            $path_name = $request->file('cover_photo')->getRealPath();
            $image_cover = Cloudinary::upload($path_name, ["folder" => "images/merchants/cover", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url_cover = $image_cover->getSecurePath();
            $detail_image_cover = [
                'public_id' =>  $image_cover->getPublicId(),
                'file_type' =>  $image_cover->getFileType(),
                'size'      =>  $image_cover->getReadableSize(),
                'width'     =>  $image_cover->getWidth(),
                'height'    =>  $image_cover->getHeight(),
                'extension' =>  $image_cover->getExtension(),
            ];
            $additional_image_cover = $detail_image_cover;
        } else {
            $image_url_cover = '';
            $additional_image_cover = '';
        };

        if ($request->file('seo_image')) {
            $path_name = $request->file('seo_image')->getRealPath();
            $image_cover = Cloudinary::upload($path_name, ["folder" => "images/merchants/seo", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url_seo = $image_cover->getSecurePath();
            $detail_image_seo = [
                'public_id' =>  $image_cover->getPublicId(),
                'file_type' =>  $image_cover->getFileType(),
                'size'      =>  $image_cover->getReadableSize(),
                'width'     =>  $image_cover->getWidth(),
                'height'    =>  $image_cover->getHeight(),
                'extension' =>  $image_cover->getExtension(),
            ];
            $additional_image_seo = $detail_image_seo;
        } else {
            $image_url_seo = '';
            $additional_image_seo = '';
        };

        $additional_image = [
            'logo'  => $additional_image_logo,
            'cover' => $additional_image_cover,
        ];
        $additional_image_json = json_encode($additional_image);
        $additional_image_seo_json = json_encode($additional_image_seo);

        Merchant::create([
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
            'status'                => 1,
            'paid_partnership'      => 0,
            'minimum_order'         => 0,
            'comission'             => 0,
            'schedule_order'        => 0,
            'vendor_id'             => $vendor->id,
            'free_delivery'         => 0,
            'delivery'              => 1,
            'cover_photo'           => $image_url_cover,
            'take_away'             => 1,
            'food_section'          => 1,
            'tax'                   => $request->tax,
            'review_section'        => 1,
            'active'                => 1,
            'self_delivery_system'  => 0,
            'pos_system'            => 0,
            'cash_on_delivery'      => 0,
            'seo_image'             => $image_url_seo,
            'additional_seo_image'  => $additional_image_seo_json,
            'merchant_special'      => $request->merchant_special ?? ''
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.master-merchant');
    }
    public function master_merchant_edit($id)
    {
        $master_merchant = Merchant::find($id);
        return view('admin.merchant.edit', [
            'master_merchant' => Merchant::find($id),
            'merchant_group' => MerchantGroup::get(),
            'master_merchant_vendor' => Vendor::where('id', $master_merchant->vendor_id)->first(),
            'categories_position_0' => Category::where([['position','=',0],['status','=',1]])->get(),
            'categories_position_1' => Category::where([['position','=',1],['parent_id','=',$master_merchant->category_id],['status','=',1]])->get()
        ]);
    }
    public function master_merchant_update(Request $request, $id)
    {
        $master_merchant = Merchant::find($id);
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:merchants,slug,' . $id,
            'district' => 'required',
            'main_category_id' => 'required',
            'categories_id' => 'required',
            'merchant_special' => 'sometimes',
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
            if (substr($master_merchant->logo, 0, 4) == 'http') {
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
            $additional_image_logo = $key->logo ?? '';
            $image_url_logo = $master_merchant->logo ?? '';
        };

        if ($request->file('cover_photo')) {
            if (substr($master_merchant->cover_photo, 0, 4) == 'http') {
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
            $additional_image_cover = $key->cover ?? '';
            $image_url_cover = $master_merchant->cover_photo ?? '';
        };

        if ($request->file('seo_image')) {
            if (substr($master_merchant->seo_image, 0, 4) == 'http') {
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
        return redirect()->route('admin.master-merchant');
    }
    public function master_merchant_delete($id)
    {
        $master_merchant = Merchant::find($id);
        $check_product = DB::table('products')->where('merchant_id', $master_merchant->id)->count('merchant_id');
        if ($check_product > 0) {
            return response()->json(['status' => 201]);
        } else {
            if ($master_merchant->logo) {
                $key = json_decode($master_merchant->additional_image);
                Cloudinary::destroy($key->logo->public_id);
                if ($key->cover) {
                    Cloudinary::destroy($key->cover->public_id);
                }
            }
            if ($master_merchant->seo_image) {
                $key = json_decode($master_merchant->additional_seo_image);
                Cloudinary::destroy($key->public_id);
            }
            $master_merchant->delete();
            $vendor = DB::table('vendors')->where('id', $master_merchant->vendor_id);
            $vendor->delete();
            return response()->json(['status' => 200]);
        }
    }
    public function master_merchant_status(Request $request)
    {
        $master_merchant = Merchant::find($request->id);
        $master_merchant->update(['status' => $request->status]);

        $vendor = Vendor::find($master_merchant->vendor_id);
        $vendor->update(['status' => $request->status]);

        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-merchant');
    }
    public function master_merchant_favorite(Request $request)
    {
        $master_merchant = Merchant::withoutGlobalScopes()->find($request->id);
        $master_merchant->merchant_favorite = $request->favorite;
        $master_merchant->save();

        Alert::toast('Favorite Updated', 'success');
        return redirect('/admin/master-merchant');
    }

    public function master_merchant_paidPartnership(Request $request)
    {
        $master_merchant = Merchant::withoutGlobalScopes()->find($request->id);
        $master_merchant->paid_partnership = $request->paidPartnership;
        $master_merchant->save();

        Alert::toast('Paid Partnership Updated', 'success');
        return redirect('/admin/master-merchant');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MerchantController extends Controller
{
    public function master_merchant_index(){
        $master_merchants = Merchant::join('vendors', 'merchants.vendor_id', '=', 'vendors.id')->get();
        return view('admin.merchant.index', compact('master_merchants'));
    }
    public function master_merchant_add(){
        $main_categories = Category::where(['position' => 0 ])->get();
        return view('admin.merchant.add', compact('main_categories'));
    }
    public function master_merchant_store(Request $request){
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'district' => 'required',
            'main_category_id' => 'required',
            'categories_id' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'email' => 'required|unique:vendors',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:vendors',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
            'cover_photo' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'tax' => 'required',
        ], [
            'f_name.required' => 'The first name field is required.'
        ]);
        // if ($validator->fails()) {
        //     return back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $category_ids = Category::find($request->main_category_id);
        $json_category_ids = json_encode(['id' => $category_ids->id, 'slug' => $category_ids->slug]);
        $categories_id = implode(',', array($request->categories_id));
        dd($request);
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

        $additional_image = [
            'logo'  => $additional_image_logo,
            'cover' => $additional_image_cover
        ];
        $additional_image_json = json_encode($additional_image);

        $merchant = Merchant::create([
            'name'             => $request->name,
            'slug'             => $request->slug,
            'category_id'      => $request->main_category_id,
            'category_ids'     => $json_category_ids,
            'categories_id'    => $categories_id,
            'categories_ids'   => $json_categories_ids,
            'merchant_type'    => $request->merchant_type,
            'phone'            => $request->phone,
            'email'            => $request->email,
            'logo'             => $image_url_logo,
            'cover_photo'      => $image_url_cover,
            'district'         => $request->district,
            'address'          => $request->address,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'vendor_id'        => $vendor->id,
            'tax'              => $request->tax,
            'delivery_time'    => '10 - 30',
            'delivery_time'    => $request->minimum_delivery_time . '-' . $request->maximum_delivery_time,
            'additional_image' => $additional_image_json

        ]);
        $merchant->categories()->sync(request('categories_id'));
        // return redirect()->route('admin.master-merchant');

    }
}
?>

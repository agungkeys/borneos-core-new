<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Merchant;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    public function master_banner_index(Request $request){
        $filter = $request->query('filter');
        $merchant = Merchant::where(['vendor_id' => Auth::guard('merchant')->user()->id])->first();
        if (!empty($filter)){
            $banners = Banner::sortable()
            ->where([['banners.title', 'like', '%'.$filter.'%'], ['merchant_id', '=', $merchant->id ]])
            ->orWhere([['banners.url', 'like', '%'.$filter.'%'], ['merchant_id', '=', $merchant->id ]])
            ->paginate(10);
        } else {
            $banners = Banner::sortable()->where('merchant_id', $merchant->id)->paginate(10);
        }

        return view('merchant.banner.index', compact('banners', 'filter'));
    }

    public function master_banner_status(Request $request){
        $banner = Banner::withoutGlobalScopes()->find($request->id);

        $banner->status = $request->status;
        $banner->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('merchant.master-banner');
    }

    public function master_banner_add(){
        return view('merchant.banner.add');
    }

    public function master_banner_store(Request $request){
        $merchant = Merchant::where(['vendor_id' => Auth::guard('merchant')->user()->id])->first();

        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
            'url' => 'nullable',
        ]);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/banners", "overwrite" => TRUE, "resource_type" => "image"]);
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
        } else {
            $image_url = '';
        };

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->image = $image_url;
        $banner->url = $request->url;
        $banner->status = 1;
        $banner->merchant_id = $merchant->id;
        $banner->admin_id = $merchant->id;

        $banner->save();
        Alert::success('Success', 'Data saved succesfully!');
        return redirect()->route('merchant.master-banner');
    }

    public function master_banner_edit($id){
        $merchant = Merchant::where(['vendor_id' => Auth::guard('merchant')->user()->id])->first();
        $banner = Banner::where([['merchant_id', '=', $merchant->id], ['id', '=', $id]])->first();

        if ($banner){
            return view('merchant.banner.edit', [
                'banner' => $banner
            ]);
        }else{
            return abort(404);
        }
    }

    public function master_banner_update(Request $request, $id){
        $banner = Banner::findOrFail($id);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/banners", "overwrite" => TRUE, "resource_type" => "image"]);
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
        } else {
            $image_url = $banner->image;
        };

        $banner->title = $request->title;
        $banner->type = $banner->type;
        $banner->image = $image_url;
        $banner->url = $request->url;
        $banner->status = $banner->status;
        $banner->merchant_id = $banner->merchant_id;
        $banner->admin_id = $banner->admin_id;

        $banner->save();
        Alert::success('Success', 'Data updated succesfully!');
        return redirect()->route('merchant.master-banner');
    }

    public function master_banner_delete($id){
        $banner = Banner::findOrFail($id);

        $banner->delete();
        return response()->json(['status' => 200]);
    }

}

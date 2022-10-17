<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Banner;
use App\Models\Merchant;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    use CloudinaryImage;

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

    public function master_banner_status(Request $request)
    {
        $banner = Banner::withoutGlobalScopes()->find($request->id);
        $banner->status = $request->status;
        $banner->save();
        Alert::toast('Status updated!', 'success');
        return redirect()->route('merchant.master-banner');
    }

    public function master_banner_add(){
        return view('merchant.banner.add');
    }

    public function master_banner_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type'  => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
            'url'   => 'nullable',
        ]);
        
        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/banners']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = '';
            $additional_image = '';
        };
        
        $merchant = Merchant::where(['vendor_id' => Auth::guard('merchant')->user()->id])->first();

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->image = $image_url;
        $banner->additional_image = $additional_image;
        $banner->url = $request->url;
        $banner->status = 1;
        $banner->merchant_id = $merchant->id;
        $banner->save();
        Alert::success('Success', 'Data saved succesfully');
        return redirect()->route('merchant.master-banner');
    }

    public function master_banner_edit($id)
    {
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

    public function master_banner_update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'type'  => 'sometimes',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'url'   => 'sometimes',
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'images/banners',
                'collection' => $banner
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }else {
            $image_url = $banner->image;
            $additional_image = $banner->additional_image;
        }

        $banner->title = $request->title;
        $banner->type = $banner->type;
        $banner->image = $image_url;
        $banner->additional_image = $additional_image;
        $banner->url = $request->url;
        $banner->status = $banner->status;
        $banner->merchant_id = $banner->merchant_id;
        $banner->save();
        Alert::success('Success', 'Data updated succesfully');
        return redirect()->route('merchant.master-banner');
    }

    public function master_banner_delete(int $id)
    {
        $banner = Banner::findOrFail($id);
         if (substr($banner->image, 0, 4) == 'http') {
            $key = json_decode($banner->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $banner->delete();
        return response()->json(['status' => 200]);
    }

}

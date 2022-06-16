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

    }


    public function master_banner_edit(){

    }
    public function master_banner_update(){

    }
    public function master_banner_delete(){

    }


}

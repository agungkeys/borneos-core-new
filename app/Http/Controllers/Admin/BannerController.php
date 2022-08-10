<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\{Banner, Merchant};
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use RealRashid\SweetAlert\Facades\Alert;


class BannerController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $banners = Banner::sortable()
                ->where('banners.title', 'like', '%' . $filter . '%')
                ->orWhere('banners.url', 'like', '%' . $filter . '%')
                ->orWhere('banners.type', 'like', '%' . $filter . '%')
                ->orWhereHas('merchant', function ($q) use ($filter) {
                    return $q->where('name', 'like', "%{$filter}%");
                })
                ->orWhereHas('admin', function ($q) use ($filter) {
                    return $q->where('f_name', 'like', "%{$filter}%")->orWhere('l_name', 'like', "%{$filter}%");
                })
                ->paginate(10);
        } else {
            $banners = Banner::sortable()->paginate(10);
        }

        return view('admin.banner.index', compact('banners', 'filter'));
    }

    public function master_banner_status(Request $request)
    {
        $banner = Banner::withoutGlobalScopes()->find($request->id);
        $banner->status = $request->status;
        $banner->save();
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.banner.index');
    }
    public function create()
    {
        return view('admin.banner.add', [
            'merchants' => Merchant::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/banners']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = '';
            $additional_image = '';
        };

        Banner::create([
            'title'            => $request->title,
            'type'             => $request->type,
            'image'            => $image_url,
            'url'              => $request->url ?? '',
            'status'           => 1,
            'merchant_id'      => $request->merchant_id ?? null,
            'admin_id'         => auth()->guard('admin')->user()->id,
            'additional_image' => $additional_image
        ]);

        Alert::success('Success', 'Data saved succesfully!');
        return redirect()->route('admin.banner.index');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', [
            'banner'    => $banner,
            'merchants' => Merchant::all()
        ]);
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'type'  => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'images/banners',
                'collection' => $banner
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        $banner->update([
            'title'            => $request->title,
            'type'             => $request->type,
            'image'            => $image_url ?? $banner->image,
            'url'              => $request->url ?? '',
            'merchant_id'      => $request->merchant_id ?? null,
            'admin_id'         => auth()->guard('admin')->user()->id,
            'additional_image' => $additional_image ?? $banner->additional_image
        ]);

        Alert::success('Success', 'Updated succesfully');
        return redirect()->route('admin.banner.index');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image && $banner->additional_image) {
            $key = json_decode($banner->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $banner->delete();
        return response()->json(['status' => 200]);
    }
}

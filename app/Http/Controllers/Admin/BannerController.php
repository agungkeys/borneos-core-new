<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Merchant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)){
            $banners = Banner::sortable()
            ->where('banners.title', 'like', '%'. $filter . '%')
            ->orWhere('banners.url', 'like', '%' .$filter. '%')
            ->paginate(10);
        } else {
            $banners = Banner::sortable()->paginate(10);
        }

        return view('admin.banner.index', compact('banners', 'filter'));
    }

    public function master_banner_status(Request $request){
        $banner = Banner::withoutGlobalScopes()->find($request->id);

        $banner->status = $request->status;
        $banner->save();

        return redirect()->route('admin.banner.index')->with('toast_success', 'Status Updated');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchants = Merchant::all();
        return view('admin.banner.add', [
            'merchants' => $merchants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
            'url' => 'nullable',
            'merchant_id' => 'nullable',
            'admin_id' => 'nullable'
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
        $banner->merchant_id = $request->merchant_id;
        $banner->admin_id = Auth::guard('admin')->user()->id;

        $banner->save();
        Alert::success('Success', 'Data saved succesfully!');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner = Banner::where('id', $id)->first();
        $merchants = Merchant::all();
        return view('admin.banner.edit', [
            'banner' => $banner,
            'merchants' => $merchants
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            $additional_image = json_encode($detail_image);
        } else {
            $image_url = $banner->image;
        };

        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->image = $image_url;
        $banner->url = $request->url;
        $banner->merchant_id = $request->merchant_id;
        $banner->admin_id = $request->admin_id;

        $banner->save();
        Alert::success('Success', 'Data updated succesfully!');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        $banner->delete();
        return response()->json(['status' => 200]);
    }
}

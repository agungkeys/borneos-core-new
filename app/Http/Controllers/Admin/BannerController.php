<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Yajra\Datatables\Datatables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use RealRashid\SweetAlert\Facades\Alert;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banners = Banner::all();
        return view('admin.banner.index', [
            'banners' => $banners
        ]);
    }

    public function getDataBanner(){
        $banners = Banner::all();

        return Datatables::of($banners)
        ->addIndexColumn()
        ->editColumn('action', function($banner){
                return '<form action="'.route('admin.banner.destroy', $banner->id).'" method="POST">
                    <a href="'.route('admin.banner.edit', [$banner->id]).'" class="btn btn-primary" title="Edit"><i class="fas fa-pen"></i></a>
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button title="Delete" type="submit" class="btn btn-link" onclick="return confirm(\'Are you sure?\')"> <i class="fas fa-trash"></i> </button>
                </form>
                ';
        })
        ->addColumn('status', function($banner){
            return "<input id='chkToggle1' type='checkbox' data-toggle='toggle' ".( $banner->status == 1 ? 'checked' : '' )." />";
        })
        ->escapeColumns([])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
            'url' => 'nullable',
            'data' => 'nullable',
            'admin_id' => 'nullable',
            'zone_id' => 'nullable'
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
            $additional_image = json_encode($detail_image);
        } else {
            $image_url = '';
        };

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->image = $image_url;
        $banner->url = $request->url;
        $banner->status = 1;
        $banner->data = $request->data;
        $banner->admin_id = $request->admin_id;
        $banner->zone_id = $request->zone_id;

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
        return view('admin.banner.edit', [
            'banner' => $banner
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
            $image_url = '';
        };


        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->image = $image_url;
        $banner->url = $request->url;
        $banner->status = $request->status;
        $banner->data = $request->data;
        $banner->admin_id = $request->admin_id;
        $banner->zone_id = $request->zone_id;

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
        //
        $banner = Banner::findOrFail($id);

        $banner->delete();
        Alert::success('Success', 'Data deleted succesfully!');
        return redirect()->route('admin.banner.index');
    }
}

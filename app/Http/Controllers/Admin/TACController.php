<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tac;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TACController extends Controller
{
    public function master_tac_index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)){
            $tacs = Tac::sortable()
            ->where('tacs.title', 'like', '%'. $filter . '%')
            ->paginate(10);
        } else {
            $tacs = Tac::sortable()->paginate(10);
        }
        return view('admin.tac.index', compact('tacs', 'filter'));
    }

    public function master_tac_status(Request $request){
        $tac = Tac::withoutGlobalScopes()->find($request->id);

        $tac->status = $request->status;
        $tac->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.master-tac');
    }

    public function master_tac_create(){
        return view('admin.tac.add');
    }

    public function master_tac_store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required||image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/tac", "overwrite" => TRUE, "resource_type" => "image"]);
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

        $tac = new Tac();
        $tac->title = $request->title;
        $tac->description = $request->description;
        $tac->image = $image_url;
        $tac->position = $request->position;
        $tac->type = $request->type;
        $tac->status = 1;

        $tac->save();
        Alert::success('Success', 'Data saved successfully');
        return redirect()->route('admin.master-tac');
    }

    public function master_tac_edit($id){

    }

    public function master_tac_update(Request $request, $id){

    }
}

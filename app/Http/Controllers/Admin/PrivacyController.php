<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PrivacyController extends Controller
{
    public function privacy_index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)){
            $privacies = PrivacyPolicy::sortable()
            ->where('privacies.title', 'like', '%'. $filter . '%')
            ->paginate(10);
        } else {
            $privacies = PrivacyPolicy::sortable()->paginate(10);
        }
        return view('admin.privacy.index', compact('privacies', 'filter'));
    }

    public function privacy_status(Request $request){
        $privacy = PrivacyPolicy::withoutGlobalScopes()->find($request->id);

        $privacy->status = $request->status;
        $privacy->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.privacy-policy');
    }

    public function privacy_create(){
        return view('admin.privacy.add');
    }

    public function privacy_store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/privacy_policy", "overwrite" => TRUE, "resource_type" => "image"]);
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

        $privacy = new PrivacyPolicy();
        $privacy->title = $request->title;
        $privacy->description = $request->description;
        $privacy->image = $image_url;
        $privacy->position = $request->position;
        $privacy->type = $request->type;
        $privacy->status = 1;

        $privacy->save();
        Alert::success('Success', 'Data saved successfully');
        return redirect()->route('admin.privacy-policy');
    }
}

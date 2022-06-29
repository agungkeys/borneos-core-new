<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralController extends Controller
{
    public function general_index(){
        $generals = General::get();
        return view('admin.general.index', [
            'generals' => $generals
        ]);
    }

    public function general_store(Request $request){
        if ($request->file('logo')) {
            $path_name = $request->file('logo')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/general", "overwrite" => TRUE, "resource_type" => "image"]);
            $logo = $image->getSecurePath();
            $ext = substr($logo, -3);
            $ext_jpeg = substr($logo, -4);
            if ($ext == "jpg") {
                $logo_webp = substr($logo, 0, -3) . "webp";
            } else if ($ext == "png") {
                $logo_webp = substr($logo, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $logo_webp = substr($logo, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $logo_webp = substr($logo, 0, -4) . "webp";
            };
            $detail_image = [
                'public_id' =>  $image->getPublicId(),
                'file_type' =>  $image->getFileType(),
                'size'      =>  $image->getReadableSize(),
                'width'     =>  $image->getWidth(),
                'height'    =>  $image->getHeight(),
                'extension' =>  $image->getExtension(),
                'webp'      =>  $logo_webp
            ];
            $logo_additional = json_encode($detail_image);
        } else {
            $logo = '';
            $logo_additional = '';
        };

        if ($request->file('seo_image')) {
            $path_name = $request->file('seo_image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/general", "overwrite" => TRUE, "resource_type" => "image"]);
            $seo_image = $image->getSecurePath();
            $ext = substr($seo_image, -3);
            $ext_jpeg = substr($seo_image, -4);
            if ($ext == "jpg") {
                $seo_image_webp = substr($seo_image, 0, -3) . "webp";
            } else if ($ext == "png") {
                $seo_image_webp = substr($seo_image, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $seo_image_webp = substr($seo_image, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $seo_image_webp = substr($seo_image, 0, -4) . "webp";
            };
            $detail_image = [
                'public_id' =>  $image->getPublicId(),
                'file_type' =>  $image->getFileType(),
                'size'      =>  $image->getReadableSize(),
                'width'     =>  $image->getWidth(),
                'height'    =>  $image->getHeight(),
                'extension' =>  $image->getExtension(),
                'webp'      =>  $seo_image_webp
            ];
            $seo_image_additional = json_encode($detail_image);
        } else {
            $seo_image = '';
            $seo_image_additional = '';
        };

        $general = new General();
        $general->title = $request->title;
        $general->description = $request->description;
        $general->logo = $logo;
        $general->logo_additional = $logo_additional;
        $general->address = $request->address;
        $general->address_lat = $request->address_lat;
        $general->address_lng = $request->address_lng;
        $general->phone = $request->phone;
        $general->email = $request->email;
        $general->footer_text = $request->footer_text;
        $general->seo_title = $request->seo_title;
        $general->seo_description = $request->seo_description;
        $general->seo_author = $request->seo_author;
        $general->seo_keywords = $request->seo_keywords;
        $general->seo_image = $seo_image;
        $general->seo_image_additional = $seo_image_additional;
        $general->seo_twitter_link = $request->seo_twitter_link;
        $general->seo_facebook_link = $request->seo_facebook_link;
        $general->maintenance_mode = 0;
        $general->min_delivery_charge = $request->min_delivery_charge;
        $general->min_charge_per_km = $request->min_charge_per_km;
        $general->delivery_charge_per_km = $request->delivery_charge_per_km;

        $general->save();
        Alert::success('Success', 'Data saved succesfully');
        return redirect()->route('admin.general');
    }

    public function general_update(Request $request, $id){
         $general = General::findOrFail($id);

        if ($request->file('logo')) {
            $path_name = $request->file('logo')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/general", "overwrite" => TRUE, "resource_type" => "image"]);
            $logo = $image->getSecurePath();
            $ext = substr($logo, -3);
            $ext_jpeg = substr($logo, -4);
            if ($ext == "jpg") {
                $logo_webp = substr($logo, 0, -3) . "webp";
            } else if ($ext == "png") {
                $logo_webp = substr($logo, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $logo_webp = substr($logo, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $logo_webp = substr($logo, 0, -4) . "webp";
            };
            $detail_image = [
                'public_id' =>  $image->getPublicId(),
                'file_type' =>  $image->getFileType(),
                'size'      =>  $image->getReadableSize(),
                'width'     =>  $image->getWidth(),
                'height'    =>  $image->getHeight(),
                'extension' =>  $image->getExtension(),
                'webp'      =>  $logo_webp
            ];
            $logo_additional = json_encode($detail_image);
        } else {
            $logo = '';
            $logo_additional = '';
        };

        if ($request->file('seo_image')) {
            $path_name = $request->file('seo_image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/general", "overwrite" => TRUE, "resource_type" => "image"]);
            $seo_image = $image->getSecurePath();
            $ext = substr($seo_image, -3);
            $ext_jpeg = substr($seo_image, -4);
            if ($ext == "jpg") {
                $seo_image_webp = substr($seo_image, 0, -3) . "webp";
            } else if ($ext == "png") {
                $seo_image_webp = substr($seo_image, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $seo_image_webp = substr($seo_image, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $seo_image_webp = substr($seo_image, 0, -4) . "webp";
            };
            $detail_image = [
                'public_id' =>  $image->getPublicId(),
                'file_type' =>  $image->getFileType(),
                'size'      =>  $image->getReadableSize(),
                'width'     =>  $image->getWidth(),
                'height'    =>  $image->getHeight(),
                'extension' =>  $image->getExtension(),
                'webp'      =>  $seo_image_webp
            ];
            $seo_image_additional = json_encode($detail_image);
        } else {
            $seo_image = $general->seo_image;
            $seo_image_additional = $general->seo_image_additional;
        };

        $general->title = $request->title;
        $general->description = $request->description;
        $general->logo = $logo;
        $general->logo_additional = $logo_additional;
        $general->address = $request->address;
        $general->address_lat = $request->address_lat;
        $general->address_lng = $request->address_lng;
        $general->phone = $request->phone;
        $general->email = $request->email;
        $general->footer_text = $request->footer_text;
        $general->seo_title = $request->seo_title;
        $general->seo_description = $request->seo_description;
        $general->seo_author = $request->seo_author;
        $general->seo_keywords = $request->seo_keywords;
        $general->seo_image = $seo_image;
        $general->seo_image_additional = $seo_image_additional;
        $general->seo_twitter_link = $request->seo_twitter_link;
        $general->seo_facebook_link = $request->seo_facebook_link;
        $general->maintenance_mode = 0;
        $general->min_delivery_charge = $request->min_delivery_charge;
        $general->min_charge_per_km = $request->min_charge_per_km;
        $general->delivery_charge_per_km = $request->delivery_charge_per_km;

        $general->save();
        Alert::success('Success', 'Data saved succesfully');
        return redirect()->route('admin.general');
    }
}

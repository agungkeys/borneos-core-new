<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Merchant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    public function faq_index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)){
            $faqs = Faq::sortable()
            ->where('faqs.title', 'like', '%'. $filter . '%')
            ->paginate(10);
        } else {
            $faqs = Faq::sortable()->paginate(10);
        }
        return view('admin.faq.index', compact('faqs', 'filter'));
    }

    public function faq_status(Request $request){
        $faq = Faq::withoutGlobalScopes()->find($request->id);

        $faq->status = $request->status;
        $faq->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.faq');
    }

    public function faq_create(){
        $merchants = Merchant::all();
        return view('admin.faq.add', [
            'merchants' => $merchants
        ]);
    }

    public function faq_store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/faq", "overwrite" => TRUE, "resource_type" => "image"]);
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

        $faq = new Faq();
        $faq->merchant_id = $request->merchant_id;
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->image = $image_url;
        $faq->position = $request->position;
        $faq->type = $request->type;
        $faq->status = 1;

        $faq->save();
        Alert::success('Success', 'Data saved successfully');
        return redirect()->route('admin.faq');
    }

    public function faq_edit($id){
        $faq = Faq::findOrFail($id);
        $merchants = Merchant::all();
        return view('admin.faq.edit', [
            'faq' => $faq,
            'merchants' => $merchants
        ]);
    }

    public function faq_update(Request $request, $id){
        $faq = Faq::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/faq", "overwrite" => TRUE, "resource_type" => "image"]);
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
            $image_url = $faq->image;
        };

        $faq->merchant_id = $request->merchant_id;
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->image = $image_url;
        $faq->position = $request->position;
        $faq->type = $request->type;
        $faq->status = 1;

        $faq->save();
        Alert::success('Success', 'Data updated successfully');
        return redirect()->route('admin.faq');
    }
}

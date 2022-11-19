<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\MerchantGroup;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MerchantGroupController extends Controller
{
    use CloudinaryImage;    

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_merchant_group = MerchantGroup::sortable()
                ->where('merchant-groups.name', 'like', '%' . $filter . '%')
                ->orWhere('merchant-groups.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_merchant_group = MerchantGroup::sortable()->paginate(10);
        }
        return view('admin.merchant-groups.index', compact('master_merchant_group', 'filter'));
    }
    public function add()
    {
        return view('admin.merchant-groups.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:merchant-groups,name',
            'slug' => 'required|unique:merchant-groups,slug',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/merchant-group']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = '';
            $additional_image = '';
        };
        MerchantGroup::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'flat_delivery' => $request->flat_delivery == 'on' ? 1 : 0,
            'image' => $image_url,
            'additional_image' => $additional_image
        ]);
        Alert::success("Success", "Created Successfully");
        return redirect()->route('admin.master-merchant-group.index');
    }
    public function edit($id)
    {
        return view('admin.merchant-groups.edit',[
            'merchant_group' => MerchantGroup::findOrFail($id)
        ]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image'=> 'sometimes|image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        $merchant_group = MerchantGroup::findOrFail($id);
        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'images/merchant-group',
                'collection' => $merchant_group
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        } else {
            $image_url = $merchant_group->image;
            $additional_image = $merchant_group->additional_image;
        }
        $merchant_group->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'flat_delivery' => $request->flat_delivery == 'on' ? 1 : 0,
            'image' => $image_url,
            'additional_image' => $additional_image
        ]);
        Alert::success("Success", "Updated Successfully");
        return redirect()->route('admin.master-merchant-group.index');
    }
    public function destroy($id)
    {
        $merchant_group = MerchantGroup::findOrFail($id);
        if (substr($merchant_group->image, 0, 4) == 'http' && $merchant_group->additional_image) {
            $key = json_decode($merchant_group->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $merchant_group->delete();
        return response()->json(['status' => 200]);
    }
}

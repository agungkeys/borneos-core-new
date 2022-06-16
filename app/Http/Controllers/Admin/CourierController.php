<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CourierController extends Controller
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
            $couriers = Courier::sortable()
            ->where('couriers.name', 'like', '%'. $filter . '%')
            ->orWhere('couriers.phone', 'like', '%' .$filter. '%')
            ->orWhere('couriers.address', 'like', '%' .$filter. '%')
            ->paginate(10);
        } else {
            $couriers = Courier::sortable()->paginate(10);
        }

        return view('admin.couriers.index', compact('couriers', 'filter'));
    }

    public function master_courier_status(Request $request){
        $courier = Courier::withoutGlobalScopes()->find($request->id);

        $courier->status = $request->status;
        $courier->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.courier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.couriers.add');
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
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'email|required',
            'password' => 'required',
            'identity_type' => 'required',
            'identity_no' => 'required',
            'identity_image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'profile_image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'badge' => 'required',
            'join_date' => 'date|required'
        ]);

        if ($request->file('identity_image')) {
            $path_name = $request->file('identity_image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/couriers", "overwrite" => TRUE, "resource_type" => "image"]);
            $identity_image = $image->getSecurePath();
            $ext = substr($identity_image, -3);
            $ext_jpeg = substr($identity_image, -4);

            if ($ext == "jpg") {
                $image_url_webp = substr($identity_image, 0, -3) . "webp";
            } else if ($ext == "png") {
                $image_url_webp = substr($identity_image, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $image_url_webp = substr($identity_image, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $image_url_webp = substr($identity_image, 0, -4) . "webp";
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
            $identity_additional_image = json_encode($detail_image);
        } else {
            $identity_image = '';
            $identity_additional_image = '';
        };

        if ($request->file('profile_image')) {
            $path_name = $request->file('profile_image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/couriers", "overwrite" => TRUE, "resource_type" => "image"]);
            $profile_image = $image->getSecurePath();
            $ext = substr($profile_image, -3);
            $ext_jpeg = substr($profile_image, -4);

            if ($ext == "jpg") {
                $image_url_webp = substr($profile_image, 0, -3) . "webp";
            } else if ($ext == "png") {
                $image_url_webp = substr($profile_image, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $image_url_webp = substr($profile_image, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $image_url_webp = substr($profile_image, 0, -4) . "webp";
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
            $profile_additional_image = json_encode($detail_image);
        } else {
            $profile_image = '';
            $profile_additional_image = '';
        };

        $courier = new Courier();

        $courier->name = $request->name;
        $courier->phone = $request->phone;
        $courier->address = $request->address;
        $courier->email = $request->email;
        $courier->password = Hash::make($request->password);
        $courier->address_lat = $request->address_lat;
        $courier->address_lang = $request->address_lang;
        $courier->identity_type = $request->identity_type;
        $courier->identity_no = $request->identity_no;
        $courier->identity_expired = $request->identity_expired;
        $courier->identity_image = $identity_image;
        $courier->identity_additional_image = $identity_additional_image;
        $courier->profile_image = $profile_image;
        $courier->profile_additional_image = $profile_additional_image;
        $courier->badge = $request->badge;
        $courier->join_date = $request->join_date;

        $courier->save();
        Alert::success('Success', 'Data saved succesfully!');
        return redirect()->route('admin.courier.index');
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
        $courier = Courier::where('id', $id)->first();

        return view('admin.couriers.edit', [
            'courier' => $courier
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

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'email|required',
            'identity_type' => 'required',
            'identity_no' => 'required',
            'identity_image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'profile_image' => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'badge' => 'required',
            'join_date' => 'date|required'
        ]);

        $courier = Courier::findOrFail($id);

        if ($request->file('identity_image')) {
            $path_name = $request->file('identity_image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/couriers", "overwrite" => TRUE, "resource_type" => "image"]);
            $identity_image = $image->getSecurePath();
            $ext = substr($identity_image, -3);
            $ext_jpeg = substr($identity_image, -4);

            if ($ext == "jpg") {
                $image_url_webp = substr($identity_image, 0, -3) . "webp";
            } else if ($ext == "png") {
                $image_url_webp = substr($identity_image, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $image_url_webp = substr($identity_image, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $image_url_webp = substr($identity_image, 0, -4) . "webp";
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
            $identity_additional_image = json_encode($detail_image);
        } else {
            $identity_image = $courier->identity_image;
            $identity_additional_image = $courier->identity_additional_image;
        };

        if ($request->file('profile_image')) {
            $path_name = $request->file('profile_image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/couriers", "overwrite" => TRUE, "resource_type" => "image"]);
            $profile_image = $image->getSecurePath();
            $ext = substr($profile_image, -3);
            $ext_jpeg = substr($profile_image, -4);

            if ($ext == "jpg") {
                $image_url_webp = substr($profile_image, 0, -3) . "webp";
            } else if ($ext == "png") {
                $image_url_webp = substr($profile_image, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $image_url_webp = substr($profile_image, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $image_url_webp = substr($profile_image, 0, -4) . "webp";
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
            $profile_additional_image = json_encode($detail_image);
        } else {
            $profile_image = $courier->profile_image;
            $profile_additional_image = $courier->profile_additional_image;
        };

        $courier->name = $request->name;
        $courier->phone = $request->phone;
        $courier->address = $request->address;
        $courier->email = $request->email;
        $courier->password = $request->password ? Hash::make($request->password) : $courier->password;
        $courier->address_lat = $request->address_lat;
        $courier->address_lang = $request->address_lang;
        $courier->identity_type = $request->identity_type;
        $courier->identity_no = $request->identity_no;
        $courier->identity_expired = $request->identity_expired;
        $courier->identity_image = $identity_image;
        $courier->identity_additional_image = $identity_additional_image;
        $courier->profile_image = $profile_image;
        $courier->profile_additional_image = $profile_additional_image;
        $courier->badge = $request->badge;
        $courier->join_date = $request->join_date;

        $courier->save();
        Alert::success('Success', 'Data updated succesfully!');
        return redirect()->route('admin.courier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courier = Courier::findOrFail($id);

        $courier->delete();
        return response()->json(['status' => 200]);
    }
}

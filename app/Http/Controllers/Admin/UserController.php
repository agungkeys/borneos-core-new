<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRole;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function master_user_index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $master_users = Admin::sortable()
                ->where('admins.f_name', 'like', '%' . $filter . '%')
                ->orWhere('admins.l_name', 'like', '%' . $filter . '%')
                ->orWhere('admins.phone', 'like', '%' . $filter . '%')
                ->orWhere('admins.email', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $master_users = Admin::sortable()->paginate(10);
        }
        return view('admin.user.index', compact('master_users', 'filter'));
    }
    public function master_user_status(Request $request)
    {
        $product = Admin::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/admin/master-user');
    }
    public function master_user_add()
    {
        return view('admin.user.add', [
            'admin_roles' => AdminRole::all()
        ]);
    }
    public function master_user_store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'phone'      => 'required|numeric',
            'email'      => 'required|unique:admins,email',
            'role'       => 'required',
            'password'   => 'required|min:6',
            'image'      => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/users", "overwrite" => TRUE, "resource_type" => "image"]);
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
            $additional_image = '';
        };
        Admin::create([
            'f_name'   => $request->first_name,
            'l_name'   => $request->last_name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role_id'  => $request->role,
            'status'   => 1,
            'image'    => $image_url,
            'additional_image' => $additional_image,
        ]);
        Alert::success('Success', 'Created Successfully');
        return redirect()->route('admin.master-user');
    }
}

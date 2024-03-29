<?php

namespace App\Http\Controllers\Courier\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Merchant;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:courier', ['except' => 'logout']);
    }

    public function login()
    {
        return view('courier.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $courier = Courier::where('email', $request->email)->first();
        if($courier)
        {
            if($courier->status == 0)
            {
                Alert::toast('Akun anda belum di aktivasi, silahkan hubungi admin', 'warning');
                return redirect()->back();
            }
        }
        if (auth('courier')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('courier.dashboard');
        }
        Alert::toast('Email dan kata sandi tidak cocok ', 'error');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        auth()->guard('courier')->logout();
        return redirect()->route('courier.auth.login');
    }

    public function register()
    {
        return view('courier.auth.register');
    }

    public function register_submit(Request $request)
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
        $courier->status = 0;

        $courier->save();
        return redirect()->route('courier.auth.thanks.page');
    }

    public function thanks()
    {
        return view('courier.auth.thanks');
    }
}

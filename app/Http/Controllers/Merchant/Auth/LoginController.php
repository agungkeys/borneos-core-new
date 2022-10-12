<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:merchant', ['except' => 'logout']);
    }

    public function login()
    {
        return view('merchant.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $vendor = Vendor::where('email', $request->email)->first();
        if($vendor)
        {
            // if($vendor->status == 0 && $vendor->email_verified_at== NULL)
            if($vendor->status == 0 )
            {
                Alert::toast('Akun anda belum di aktivasi, silahkan cek email atau hubungi admin', 'warning');
                return redirect()->back();
            }
            // else{
            //     Alert::toast('Akun anda di nonaktifkan, silahkan hubungi admin', 'warning');
            //     return redirect()->back();
            // }
        }
        if (auth('merchant')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('merchant.dashboard');
        }
        Alert::toast('Email dan kata sandi tidak cocok ', 'error');
        return redirect()->back();
    }

    public function register()
    {
        $main_categories = Category::where(['position' => 0 ])->get();
        return view('merchant.auth.register', compact('main_categories'));
    }

    public function register_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'district' => 'required',
            'main_category_id' => 'required',
            'categories_id' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'email' => 'required|unique:vendors',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:vendors',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
        ], [
            'f_name.required' => 'The first name field is required.'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $category_ids = Category::find($request->main_category_id);
        $json_category_ids = json_encode(['id' => $category_ids->id, 'slug' => $category_ids->slug]);
        $categories_id = implode(',', $request->categories_id);
        $categories = Category::whereIn('id', $request->categories_id)->get();
        if ($categories->count() == 1) {
            $categories_ids = ['id' => $categories[0]->id, 'name' => $categories[0]->name, 'slug' => $categories[0]->slug];
        } elseif ($categories->count() > 1) {
            foreach ($categories as $category) {
                $categories_ids[] = ['id' => $category->id, 'name' => $category->name, 'slug' => $category->slug];
            }
        }

        $json_categories_ids = json_encode($categories_ids);

        function generateRandomString($length = 30) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
             return date('dm').$randomString.date('s');
        }

        $vendor = new Vendor();
        $vendor->f_name = $request->f_name;
        $vendor->l_name = $request->l_name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->password = bcrypt($request->password);
        $vendor->auth_token = generateRandomString();
        $vendor->status = 0;
        $vendor->save();

        if ($request->file('logo')) {
            $path_name = $request->file('logo')->getRealPath();
            $image_logo = Cloudinary::upload($path_name, ["folder" => "images/merchants/logo", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url_logo = $image_logo->getSecurePath();
            $detail_image_logo = [
                'public_id' =>  $image_logo->getPublicId(),
                'file_type' =>  $image_logo->getFileType(),
                'size'      =>  $image_logo->getReadableSize(),
                'width'     =>  $image_logo->getWidth(),
                'height'    =>  $image_logo->getHeight(),
                'extension' =>  $image_logo->getExtension(),
            ];
            $additional_image_logo = $detail_image_logo;
        } else {
            $image_url_logo = '';
            $additional_image_logo = '';
        };

        $additional_image = [
            'logo'  => $additional_image_logo,
            'cover' => "",
        ];
        $additional_image_json = json_encode($additional_image);

        $merchant = Merchant::create([
            'category_id'           => $request->main_category_id,
            'category_ids'          => $json_category_ids,
            'categories_id'         => $categories_id,
            'categories_ids'        => $json_categories_ids,
            'name'                  => $request->name,
            'slug'                  => $request->slug,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
            'logo'                  => $image_url_logo,
            'additional_image'      => $additional_image_json,
            'latitude'              => $request->latitude,
            'longitude'             => $request->longitude,
            'district'              => $request->district,
            'address'               => $request->address,
            'minimum_order'         => 0,
            'comission'             => 0,
            'schedule_order'        => 0,
            'vendor_id'             => $vendor->id,
            'status'                => 0,
            'free_delivery'         => 0,
            'delivery'              => 1,
            'take_away'             => 1,
            'food_section'          => 1,
            'tax'                   => 0,
            'review_section'        => 1,
            'active'                => 0,
            'self_delivery_system'  => 0,
            'pos_system'            => 0,
            'cash_on_delivery'      => 0
        ]);
        return redirect()->route('merchant.auth.thanks', ['id' => $vendor->id]);
    }

    public function logout(Request $request)
    {
        auth()->guard('merchant')->logout();
        return redirect()->route('merchant.auth.login');
    }

    public function verify($id)
    {
        $merchant=Vendor::where('auth_token', $id)->first();

        if (!$merchant) {
            Alert::warning('Error', 'Akun anda tidak berhasil di aktivasi');
            return redirect()->route('merchant.auth.login');
        }

        function generateRandomString($length = 30) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
             return date('dm').$randomString.date('s');
        }

        Vendor::where('email', $merchant->email)->update([
            'status'                => 1,
            'email_verified_at'     => date('Y-m-d H:i:s'),
            'auth_token'            => generateRandomString()
        ]);
        Merchant::where('email', $merchant->email)->update([
            'status'    => 1,
            'active'    => 1
        ]);

        Alert::warning('Email Anda Telah Terverifikasi', 'Silahkan Login');
        return redirect()->route('merchant.auth.login');
    }

    public function forget(Request $request){
        $vendor = Vendor::where('email',$request->email)->first();
        if ($vendor) {
            $merchant = Merchant::where('vendor_id',$vendor->id)->first();
            $details = [
                'button' => $vendor->auth_token,
                'merchant' => $merchant->name
            ];
            Mail::to($vendor->email)->send(new \App\Mail\SendEmailForget($details));
            return view('merchant.auth.thanksForget',compact('vendor'));
        }
        else{
            Alert::error('Tidak Ditemukan!', 'Email Anda Tidak Terdaftar');
            return redirect()->back();
        }
    }

    public function forgetNewPassword(Request $request){
        $update = DB::table('vendors')->where('auth_token',$request->auth_token)->update(['password'=>bcrypt($request->password)]);
        Alert::toast('Kata sandi berhasil di ubah, silahkan login', 'success');
        return redirect()->route('merchant.auth.login');
    }
}

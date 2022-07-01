<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Merchant;

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
            if($vendor->status == 0)
            {
                return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors([trans('messages.inactive_vendor_warning')]);
            }
        }
        if (auth('merchant')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('merchant.dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function register()
    {
        $main_categories = Category::where(['position' => 0 ])->get();
        return view('merchant.auth.register', compact('main_categories'));
    }

    public function logout(Request $request)
    {
        auth()->guard('merchant')->logout();
        return redirect()->route('merchant.auth.login');
    }
}

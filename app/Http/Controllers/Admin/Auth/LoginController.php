<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (auth('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('admin.dashboard');
        }

        Alert::toast('Credentials does not match.', 'error');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    }
}

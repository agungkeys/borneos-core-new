<?php

namespace App\Http\Controllers\Courier\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courier;
use App\Models\Merchant;

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
                return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors([trans('messages.inactive_courier_warning')]);
            }
        }
        if (auth('courier')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('courier.dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('courier')->logout();
        return redirect()->route('courier.auth.login');
    }
}

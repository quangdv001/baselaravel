<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest.admin')->except('logout');
    }

    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->only('username', 'password');
        if (auth('admin')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('admin/');
        }
        return redirect()->back()->with('error','Tài khoản hoặc mật khẩu sai!');
    }

    public function logout(){
        auth('admin')->logout();
        return redirect()->route('admin.getLogin');
    }
}

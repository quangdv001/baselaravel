<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{

    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->only('username', 'password');
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('admin/');
        }
        return redirect()->back()->with('error','Tài khoản hoặc mật khẩu sai!');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('admin.getLogin');
    }
}

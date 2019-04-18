<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class SiteAuthController extends Controller
{
    private $user;

    public function __construct(UserService $user)
    {
        $this->middleware('guest.site')->except('site.auth.logout');
        $this->user = $user;
    }

    public function getRegister(){
        return view('site.auth.register');
    }

    public function postRegister(Request $request){
        $data = $request->only('email', 'password', 'phone', 'name', 'address', 'avatar');
        dd($data);
        $res = $this->user->create($data);
        if($res){
            if (auth('web')->attempt($data)) {
                return redirect()->intended('/');
            }
        }
        return redirect()->back()->with('error','Có lỗi xảy ra!');
    }

    public function getLogin(){
        return view('site.auth.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return redirect()->back()->with('error','Tài khoản hoặc mật khẩu sai!');
    }

    public function logout(){

    }

    public function loginGoogle(){

    }

    public function loginGoogleCallback(){

    }

    public function loginFacebook(){

    }

    public function loginFacebookCallback(){

    }
}

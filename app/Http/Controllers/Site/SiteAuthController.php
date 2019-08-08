<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class SiteAuthController extends Controller
{
    private $user;

    public function __construct(UserService $user)
    {
        $this->middleware('guest.site')->except('logout');
        $this->user = $user;
    }

    public function getRegister(){
        return view('site.auth.register');
    }

    public function postRegister(Request $request){
        $data = $request->only('email', 'password', 'phone', 'name');
        $data['password'] = bcrypt($data['password']);
        $res = $this->user->create($data);
        if($res){
            auth()->login($res, true);
            return redirect()->intended('/');
        }
        return redirect()->back()->with('error_message','Có lỗi xảy ra!');
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
        return redirect()->back()->with('error_message','Tài khoản hoặc mật khẩu sai!');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('site.auth.getLogin');
    }
}

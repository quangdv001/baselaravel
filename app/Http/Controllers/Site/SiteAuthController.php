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
        $data = $request->only('email', 'password', 'phone', 'name', 'address', 'avatar');
        $data['password'] = bcrypt($data['password']);
        $res = $this->user->create($data);
        if($res){
            auth()->login($res, true);
            return redirect()->intended('/');
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
        auth()->logout();
        return redirect()->route('site.auth.getLogin');
    }

    public function loginGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogleCallback(){
        // $user = Socialite::driver('google')->user();
        // return $user->email;
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        $existingUser = $this->user->getByEmail($user->email);
        if($existingUser){
            auth()->login($existingUser, true);
        } else {
            $data['name'] = $user->name;
            $data['avatar'] = $user->avatar;
            $data['uid'] = $user->id;
            $data['email'] = $user->email;
            $newUser = $this->user->create($data);
            auth()->login($newUser, true);
        }
        return redirect()->route('site.home.index');
    }

    public function loginFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function loginFacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        $existingUser = $this->user->getByEmail($user->email);
        if($existingUser){
            auth()->login($existingUser, true);
        } else {
            $data['name'] = $user->name;
            $data['avatar'] = $user->avatar;
            $data['uid'] = $user->id;
            $data['email'] = $user->email;
            $newUser = $this->user->create($data);
            auth()->login($newUser, true);
        }
        return redirect()->route('site.home.index');
    }
}

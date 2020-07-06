<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\RegisterRequest;
use App\Services\UserService;

class SiteAuthController extends Controller
{
    private $user;
    public function __construct(UserService $user)
    {
        // $this->middleware('guest.site')->except('logout');
        $this->user = $user;
    }

    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return redirect()->back()->with('error_message','Tài khoản hoặc mật khẩu sai!');
    }

    public function postRegister(RegisterRequest $request){
        $data = $request->only('email', 'password', 'phone', 'name');
        $data['password'] = bcrypt($data['password']);
        $data['expired_at'] = time() + 90*86400;
        $user = $this->user->create($data);
        $res['success'] = 0;
        if($user){
            auth()->login($user, true);
            $res['success'] = 1;
        }
        return response()->json($res);
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('site.home.index');
    }
}

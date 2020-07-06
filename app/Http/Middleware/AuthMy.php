<?php

namespace App\Http\Middleware;

use Closure;

class AuthMy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()){
            $user = auth()->user();
            if($user->expired_at && $user->expired_at > time()){

                return $next($request);
            }
        }
        return redirect()->route('site.home.index')->with('error_message', 'Bạn đã hết hạn sử dụng dịch vụ!');
    }
}

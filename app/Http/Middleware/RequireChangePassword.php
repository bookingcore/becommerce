<?php


namespace App\Http\Middleware;


class RequireChangePassword
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        if($user = $request->user() and $user->need_update_pw){
            if($request->expectsJson()){
                return [
                    'status'=>0,
                    'message'=>__("For security, please check your password to continue"),
                    'code'=>"need_update_pw"
                ];
            }
            return redirect('user.password',['need_update_pw'=>1]);
        }
        return $next($request);
    }
}

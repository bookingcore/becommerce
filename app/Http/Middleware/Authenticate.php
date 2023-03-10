<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login', ['redirect' => $request->getRequestUri()]);
        }
    }
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($request, $guards);
        }catch (AuthenticationException $exception)
        {
            if($request->expectsJson() or is_api())
            {
                return response()->json([
                    'status'=>0,
                    'message'=>$exception->getMessage(),
                    'require_login'=>1,
                    'code'=>'require_login'
                ],401);
            }

            return redirect(route('login', ['redirect' => $request->getRequestUri()]));

        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Updaters\Updater110;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\Role;

class MigrationTools
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
        if(strpos($request->path(),'install') === false and is_installed()){

            Updater110::run();
        }
        return $next($request);
    }
}

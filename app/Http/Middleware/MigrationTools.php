<?php

namespace App\Http\Middleware;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

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

            $this->migrateTo110();
        }
        return $next($request);
    }

    protected function migrateTo110(){
        $check = '1.1';
        if(version_compare(setting_item('migration_110_schema'),$check,'>=')) return;

        Artisan::call('migrate --force');

        Schema::table('products',function (Blueprint $table){
            if(!Schema::hasColumn('products','is_virtual')){
                $table->tinyInteger('is_virtual')->nullable()->default(0);
            }
        });

        setting_update_item('migration_110_schema',$check);
    }
}

<?php


namespace Themes\Zeomart;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouterServiceProvider extends RouteServiceProvider
{

    public function map(){
        Route::middleware('web')
            ->namespace("\\Themes\\".ucfirst(basename(__DIR__))."\\Controllers")
            ->group(__DIR__ . '/routes.php');

        $locale = app()->getLocale();
        Route::group([
            'middleware' => 'web',
            'namespace' => "\\Themes\\".ucfirst(basename(__DIR__))."\\Controllers",
            'prefix' => $locale
        ], function ($router) {
            if(is_enable_language_route()) {
                require __DIR__.'/routes.php';
            }
        });
    }
}

<?php


namespace Themes\Base;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouterServiceProvider extends RouteServiceProvider
{

    public function map(){
        Route::middleware('web')
            ->namespace("\\Themes\\".ucfirst(basename(__DIR__))."\\Controllers")
            ->group(__DIR__ . '/routes.php');
    }
}

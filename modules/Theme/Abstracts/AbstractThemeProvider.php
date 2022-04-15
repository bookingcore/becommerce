<?php
namespace Modules\Theme\Abstracts;

use Illuminate\Support\ServiceProvider;

abstract class AbstractThemeProvider extends ServiceProvider
{

    public static $name;

    public static $screenshot = '/themes/Base/screenshot.png';

    public static $version = "1.0";

    public static $seeder;

    /**
     * Return Theme Info
     *
     * @return array
     */
    abstract static function info();

    public function register(){}

    public function boot(){}
}

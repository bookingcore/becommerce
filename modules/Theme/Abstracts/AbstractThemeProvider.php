<?php
namespace Modules\Theme\Abstracts;

use Illuminate\Support\ServiceProvider;

abstract class AbstractThemeProvider extends ServiceProvider
{

    public static $name;

    public static $screenshot;

    /**
     * Return Theme Info
     *
     * @return array
     */
    abstract static function info();

    public function register(){}

}

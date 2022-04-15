<?php
namespace Modules\Theme\Abstracts;

use Illuminate\Support\ServiceProvider;

abstract class AbstractThemeProvider extends ServiceProvider
{

    public static $id;

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

    public static function last_seeder_run(){
        return (int) setting_item('theme_'.static::$id.'_seed_run');
    }
    public static function update_last_seeder_run(){
        return setting_update_item('theme_'.static::$id.'_seed_run',time());
    }
}

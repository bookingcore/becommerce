<?php
namespace Modules\Theme\Abstracts;

use Illuminate\Support\Facades\Artisan;
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
    public static function info(){
        return [];
    }

    public function register(){}

    public function boot(){}

    public static function lastSeederRun(){
        return (int) setting_item('theme_'.static::$id.'_seed_run');
    }
    public static function updateLastSeederRun(){
        return setting_update_item('theme_'.static::$id.'_seed_run',time());
    }

    public static function runSeeder(){
        $seeder = static::$seeder;

        if(!class_exists($seeder)) return;

        Artisan::call('db:seed', ['--class' => $seeder,'--force'=>true]);

        static::updateLastSeederRun();
    }

    /**
     * Get parent Theme name
     */
    public static function getParent(){}
}

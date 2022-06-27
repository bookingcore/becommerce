<?php
namespace Modules\Theme;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Helpers\StorageConfig;
use Modules\Theme\Abstracts\AbstractThemeProvider;

class ThemeManager
{
    protected static $_all = [];
    protected static $_current = false;

    public static function current(){
        if(!static::$_current) {

            static::$_current = 'base';

            $theme = strtolower(config('bc.active_theme'));

            if(static::validateTheme($theme)){
                static::$_current = $theme;
            }
        }
        return static::$_current;
    }
    public static function currentProvider(){
        return static::theme(static::current());
    }
    public static function getProviderClass($theme){
        return "\\Themes\\".ucfirst($theme)."\\ThemeProvider";
    }

    /**
     * @param $theme
     * @return bool|AbstractThemeProvider
     */
    public static function theme($theme){
        $all = static::all();
        return $all[$theme] ?? false;
    }

    public static function all(){
        if(empty(static::$_all)){
            static::loadAll();
        }
        return static::$_all;
    }

    protected static function loadAll(){
        $listThemes = array_map('basename', File::directories(base_path("themes")));
        foreach ($listThemes as $theme){
            $theme = strtolower($theme);
            $class = static::getProviderClass($theme);
            $class::$id = $theme;
            if(class_exists($class)){
                self::$_all[$theme] = $class;
            }
        }
    }

    public static function saveConfigFile($data){
        StorageConfig::save($data);
    }

    public static function validateTheme($theme){
        $class_file = base_path('themes/'.ucfirst($theme).'/ThemeProvider.php');

        if(!file_exists($class_file)){
            return false;
        }

        $class = static::getProviderClass($theme);

        if(!class_exists($class) or !is_subclass_of($class,AbstractThemeProvider::class)){
            return false;
        }
        return true;
    }
}

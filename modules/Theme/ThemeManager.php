<?php
namespace Modules\Theme;

use Illuminate\Support\Facades\File;
use Modules\Core\JsonConfigManager;
use Modules\Theme\Abstracts\AbstractThemeProvider;

class ThemeManager
{
    protected static $_all = [];

    public static function current(){
        return $_GET['_xtheme'] ?? strtolower(JsonConfigManager::get('active_theme',config('bc.active_theme')));
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
}

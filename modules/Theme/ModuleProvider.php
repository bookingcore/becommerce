<?php
namespace Modules\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use League\Flysystem\Config;
use Modules\Core\JsonConfigManager;

class ModuleProvider extends \Modules\ModuleServiceProvider
{
    public function boot(Request $request){

        if(!is_installed() || strpos($request->path(), 'install') !== false) return false;

        \Illuminate\Support\Facades\Config::set('bc.active_theme', JsonConfigManager::get('active_theme','base'));

        $active = ThemeManager::current();
        if(strtolower($active) != "base"){
            View::addLocation(base_path(DIRECTORY_SEPARATOR."themes".DIRECTORY_SEPARATOR.ucfirst($active)));
        }

        View::addLocation(base_path(DIRECTORY_SEPARATOR."themes".DIRECTORY_SEPARATOR."Base"));

    }
    public function register()
    {
        $this->app->register(\Modules\Theme\RouterServiceProvider::class);
        $class = \Modules\Theme\ThemeManager::currentProvider();
        if(class_exists($class)){
            $this->app->register($class);
        }
    }

    public static function getAdminMenu()
    {
        return [
            'theme'=>[
                'title'=>__("Themes"),
                'url'=>route("theme.admin.index"),
                "permission"=>"theme_manage",
                "position"=>50
            ]
        ];
    }
}

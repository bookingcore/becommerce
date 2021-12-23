<?php
namespace Modules\Theme;
use Illuminate\Support\Facades\View;

class ModuleProvider extends \Modules\ModuleServiceProvider
{
    public function boot(){

        if(!is_installed()) return;

        $active = ThemeManager::current();
        if($active){
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

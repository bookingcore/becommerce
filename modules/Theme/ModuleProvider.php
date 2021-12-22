<?php
namespace Modules\Theme;
class ModuleProvider extends \Modules\ModuleServiceProvider
{
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

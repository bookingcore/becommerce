<?php
namespace Modules\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use League\Flysystem\Config;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\JsonConfigManager;
use Themes\Base\ThemeProvider;

class ModuleProvider extends \Modules\ModuleServiceProvider
{
    public function boot(Request $request){

        AdminMenuManager::register("theme",[$this,'getAdminMenu']);

        if(!is_installed() || strpos($request->path(), 'install') !== false) return false;

        \Illuminate\Support\Facades\Config::set('bc.active_theme', env('BC_DEFAULT_THEME') ? env('BC_DEFAULT_THEME') : JsonConfigManager::get('active_theme','base'));

        //	 load Theme overwrite
	    $active = ThemeManager::current();

	    if(strtolower($active) != "base"){
            View::addLocation(base_path("themes".DIRECTORY_SEPARATOR.ucfirst($active)));
        }

        // Base Theme require
        View::addLocation(base_path(DIRECTORY_SEPARATOR."themes".DIRECTORY_SEPARATOR."Base"));

    }
    public function register()
    {
        $this->app->register(\Modules\Theme\RouterServiceProvider::class);
//        Base Theme require
	    $this->app->register(ThemeProvider::class);

//	    load Theme overwrite
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
                "position"=>70,
                'icon'=>"fa fa-paint-brush"
            ]
        ];
    }
}

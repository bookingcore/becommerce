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

        //	 load Theme overwrite
	    $active = ThemeManager::current();

	    if(strtolower($active) != "base"){

            $view_paths = config('view.paths');
            $view_paths[] = __DIR__.'/'.ucfirst($active).'/resources';
            config()->set('view.paths',$view_paths);

            View::addLocation(base_path("themes".DIRECTORY_SEPARATOR.ucfirst($active)));
        }

        // Base Theme require
        View::addLocation(base_path(DIRECTORY_SEPARATOR."themes".DIRECTORY_SEPARATOR."Base"));

    }

    public function register()
    {
        $this->app->register(\Modules\Theme\RouterServiceProvider::class);
        // Base Theme require
	    $this->app->register(ThemeProvider::class);

        // load Theme overwrite
	    $class = \Modules\Theme\ThemeManager::currentProvider();
	    if($class != ThemeProvider::class) {
            if (class_exists($class)) {
                $this->app->register($class);
            }
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
                'icon'=>"fa fa-paint-brush",
                "group"=>"system",
            ]
        ];
    }
}

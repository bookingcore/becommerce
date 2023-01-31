<?php
namespace Modules\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Core\Helpers\AdminMenuManager;
use Themes\Base\ThemeProvider;

class ModuleProvider extends \Modules\ModuleServiceProvider
{
    public function boot(Request $request){

        AdminMenuManager::register("theme",[$this,'getAdminMenu']);

        if(!is_installed() || strpos($request->path(), 'install') !== false) return false;

        //	 load Theme overwrite
        $active = ThemeManager::current();

        $view_paths = [];

        if(strtolower($active) != "base"){

            $view_paths[] = base_path('/themes/'.ucfirst($active).'/Views/resources');

            // ChildTheme
            $provider = ThemeManager::getProviderClass($active);
            if($parent = $provider::getParent() and $parent != 'base'){
                $view_paths[] = base_path('/themes/'.ucfirst($parent).'/Views/resources');
            }
            config()->set('view.paths',array_merge($view_paths,config('view.paths')));

            View::addLocation(base_path("themes".DIRECTORY_SEPARATOR.ucfirst($active).DIRECTORY_SEPARATOR.'Views'));
            if($parent = $provider::getParent() and $parent != 'base'){
                View::addLocation(base_path("themes".DIRECTORY_SEPARATOR.ucfirst($parent).DIRECTORY_SEPARATOR.'Views'));
            }
        }
        // Base Theme require
        View::addLocation(base_path(DIRECTORY_SEPARATOR."themes".DIRECTORY_SEPARATOR."Base".DIRECTORY_SEPARATOR.'Views'));


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

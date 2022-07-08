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

            $view_paths[] = base_path('/themes/'.ucfirst($active).'/resources');
            $view_paths[] = base_path('/themes/'.ucfirst($active).'/Views');
            $view_paths[] = base_path('/themes/'.ucfirst($active));

            // ChildTheme
            $provider = ThemeManager::getProviderClass($active);
            if($parent = $provider::getParent() and $parent != 'base'){
                $view_paths[] = base_path('/themes/'.ucfirst($parent).'/resources');
                $view_paths[] = base_path('/themes/'.ucfirst($parent).'/Views');
            }
        }

        // Base Theme require
        $view_paths[] = base_path('/themes/Base/Views');

        config()->set('view.paths',array_merge($view_paths,config('view.paths')));

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

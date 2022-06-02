<?php


namespace Themes\Educrat;


use Modules\Theme\Abstracts\AbstractThemeProvider;
use Themes\Educrat\Modules\Course\ModuleProvider;

class ThemeProvider extends AbstractThemeProvider
{


    public static $name = "Educrat";

    public static $version = '1.0';


    public function register()
    {
        $this->app->register(ModuleProvider::class);
    }

    public static function info()
    {
        // TODO: Implement info() method.
    }
}

<?php


namespace Themes\Educrat;


use Modules\Theme\Abstracts\AbstractThemeProvider;

class ThemeProvider extends AbstractThemeProvider
{


    public static $name = "Educrat";

    public static $version = '1.0';

    public static $seeder = \Themes\Educrat\Database\Seeder::class;

    public function register()
    {
        $this->app->register(\Themes\Educrat\Modules\Course\ModuleProvider::class);
        $this->app->register(\Themes\Educrat\Modules\Event\ModuleProvider::class);
    }
}

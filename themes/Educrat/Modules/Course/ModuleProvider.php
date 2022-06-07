<?php


namespace Themes\Educrat\Modules\Course;


use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Product\Models\Product;
use Themes\Educrat\Modules\Course\Models\Course;

class ModuleProvider extends ServiceProvider
{

    public function boot(){
        $this->app->bind(Product::class,Course::class);
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadViewsFrom(__DIR__.'/Views','Course');

        //AdminMenuManager::register("");
    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

}

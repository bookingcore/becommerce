<?php


namespace Themes\Educrat\Modules\Event;


use Illuminate\Support\ServiceProvider;
use Modules\Product\Models\Product;
use Themes\Educrat\Modules\Course\Models\Course;

class ModuleProvider extends ServiceProvider
{

    public function boot(){
        $this->mergeConfigFrom(__DIR__.'/Configs/bc.php','bc');
    }
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }
}

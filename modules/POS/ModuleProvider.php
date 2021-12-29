<?php


namespace Modules\POS;


use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }
}

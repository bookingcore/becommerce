<?php
namespace Modules\Installer;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

}

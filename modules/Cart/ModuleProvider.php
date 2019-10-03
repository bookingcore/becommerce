<?php
namespace Modules\Cart;
use Modules\ModuleServiceProvider;
use Modules\User\Controllers\Vendors\PayoutController;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

    }

}

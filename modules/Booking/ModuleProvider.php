<?php
namespace Modules\Booking;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->bind('cart', BravoCart::class);
    }

    public static function getAdminMenu()
    {
        return [
            'orders'=>[
                "position"=>40,
                'url'        => route('booking.admin.orders'),
                'title'      => __("Orders"),
                'icon'       => 'fa fa-dashboard',
                'permission' => 'report_view',
            ]
        ];
    }

}

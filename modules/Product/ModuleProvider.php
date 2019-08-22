<?php
namespace Modules\Product;
use Modules\ModuleServiceProvider;
use Modules\Product\Models\Space;

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
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'space'=>[
                "position"=>41,
                'url'        => 'admin/module/product',
                'title'      => __('Products'),
                'icon'       => 'icon ion-ios-cart',
                'permission' => 'product_view',
                'children'   => [
                    'add'=>[
                        'url'        => 'admin/module/product',
                        'title'      => __('All Products'),
                        'permission' => 'product_view',
                    ],
                    'create'=>[
                        'url'        => 'admin/module/product/create',
                        'title'      => __('Add new Product'),
                        'permission' => 'product_create',
                    ],
                    'attribute'=>[
                        'url'        => 'admin/module/product/attribute',
                        'title'      => __('Attributes'),
                        'permission' => 'product_manage_attributes',
                    ],

                ]
            ]
        ];
    }

    public static function getMenuBuilderTypes()
    {
        return [
            'space'=>[
                'class' => Space::class,
                'name'  => __("Spaces"),
                'items' => Space::searchForMenu(),
                'position'=>41
            ]
        ];
    }


    public static function getUserMenu()
    {
        return [
            'space' => [
                'url'        => app_get_locale() . '/user/product',
                'title'      => __("Manage Product"),
                'icon'       => 'fa fa-building-o',
                'position'   => 31,
                'permission' => 'product_view',
                'children' => [
                    [
                        'url'    => app_get_locale() . '/product/space',
                        'title'  => __("All Products"),
                    ],
                    [
                        'url'        => app_get_locale() . '/user/product/create',
                        'title'      => __("Add Product"),
                        'permission' => 'product_create',
                    ],
                ]
            ],
        ];
    }
}
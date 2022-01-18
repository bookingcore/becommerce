<?php
namespace Modules\Report;

use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SitemapHelper;

class ModuleProvider extends \Modules\ModuleServiceProvider
{
    public function boot(){
        AdminMenuManager::register("news",[$this,'getAdminMenu']);
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'report'=>[
                "position" => 110,
                'url'        => 'admin/module/contact',
                'title'      =>  __('Reports'),
                'icon'       => 'icon ion-ios-stats',
                'permission' => 'report_view',
                'children'   => [
                    'overview'=>[
                        'url'        => 'admin/module/report/overview',
                        'title'      => __('Overview'),
                        'permission' => 'report_view',
                    ],
                    'products'=>[
                        'url'        => 'admin/module/report/products',
                        'title'      => __('Products'),
                        'permission' => 'report_view',
                    ],
                    'revenue'=>[
                        'url'        => 'admin/module/report/revenue',
                        'title'      => __('Revenue'),
                        'permission' => 'report_view',
                    ],
                    'orders'=>[
                        'url'        => 'admin/module/report/orders',
                        'title'      => __('Orders'),
                        'permission' => 'report_view',
                    ]
                ]
            ],
        ];
    }
}

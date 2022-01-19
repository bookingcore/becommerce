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
                'url'        => route('report.admin.overview'),
                'title'      =>  __('Reports'),
                'icon'       => 'icon ion-ios-stats',
                'permission' => 'report_view',
                'children'   => [
                    'report_overview'=>[
                        'url'        => route('report.admin.overview'),
                        'title'      => __('Overview'),
                        'permission' => 'report_view',
                    ],
                    'report_products'=>[
                        'url'        => route('report.admin.products'),
                        'title'      => __('Products'),
                        'permission' => 'report_view',
                    ],
                    'report_revenue'=>[
                        'url'        => route('report.admin.revenue'),
                        'title'      => __('Revenue'),
                        'permission' => 'report_view',
                    ],
                    'report_orders'=>[
                        'url'        => route('report.admin.orders'),
                        'title'      => __('Orders'),
                        'permission' => 'report_view',
                    ]
                ]
            ],
        ];
    }
}

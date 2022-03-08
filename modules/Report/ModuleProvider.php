<?php
namespace Modules\Report;

use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SitemapHelper;

class ModuleProvider extends \Modules\ModuleServiceProvider
{
    public function boot(){
        AdminMenuManager::register("report",[$this,'getAdminMenu']);
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'report'=>[
                "position" => 60,
                'url'        => route('report.admin.overview'),
                'title'      =>  __('Reports'),
                'icon'       => 'icon ion-ios-stats',
                'permission' => 'report_view',
                "group"=>"sale"
            ],
        ];
    }
}

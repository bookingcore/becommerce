<?php
namespace Modules\Campaign;

use Modules\Campaign\Repositories\Contracts\CampaignRepositoryInterface;
use Modules\Campaign\Repositories\Eloquents\CampaignRepository;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot(SitemapHelper $sitemapHelper)
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        AdminMenuManager::register('campaign',[$this,'getAdminMenu']);
    }

    public static function getAdminMenu()
    {
        return [
            'campaign'=>[
                "position"=>40,
                'url'        => route('campaign.admin.index'),
                'title'      => __('Sale Campaigns'),
                'icon'       => 'fa fa-calendar',
                'permission' => 'campaign_view',
                'group'=>'catalog',
            ],
        ];
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);

        $this->app->bind(CampaignRepositoryInterface::class,CampaignRepository::class);
    }
}

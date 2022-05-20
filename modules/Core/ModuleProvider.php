<?php
namespace Modules\Core;
use Illuminate\Support\Facades\Event;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\CreateReviewEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\HookManager;
use Modules\Core\Helpers\SettingManager;
use Modules\Core\Helpers\SitemapHelper;
use Modules\Core\Listeners\CreatedServicesListen;
use Modules\Core\Listeners\CreateReviewListen;
use Modules\Core\Listeners\UpdatedServicesListen;
use Modules\Core\Providers\SearchEngineProvider;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        Event::listen(CreatedServicesEvent::class,CreatedServicesListen::class);
        Event::listen(UpdatedServiceEvent::class,UpdatedServicesListen::class);
        Event::listen(CreateReviewEvent::class,CreateReviewListen::class);

        SettingManager::register("general",[$this,'registerGeneralSetting']);
        SettingManager::register("advance",[$this,'registerAdvanceSetting']);
        SettingManager::register("style",[$this,'registerStyleSetting']);
        SettingManager::register("mobile",[$this,'registerMobileSetting']);

        AdminMenuManager::register("setting",[$this,'getAdminMenu']);
        AdminMenuManager::register_group('system',__('System'),50);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(SearchEngineProvider::class);
        $this->app->singleton(SitemapHelper::class,function($app){
            return new SitemapHelper();
        });
        $this->app->singleton('hook_manager',function(){
            return $this->app->make(HookManager::class);
        });
    }

    public static function getAdminMenu(){

        $menus = [
            'menu'=>[
                "position"=>70,
                'url'        => 'admin/module/core/menu',
                'title'      => __("Menu"),
                'icon'       => 'icon ion-ios-apps',
                'permission' => 'menu_manage',
                "group"=>"system"
            ],
            'setting'=>[
                "position"=>80,
                'url'        => route('core.admin.setting',['group'=>'general']),
                'title'      => __('System Settings'),
                'icon'       => 'icon ion-ios-cog',
                'permission' => 'setting_update',
                "group"=>"system"
            ],
            'tools'=>[
                "position"=>90,
                'url'      => 'admin/module/core/tools',
                'title'    => __("Tools"),
                'icon'     => 'icon ion-ios-hammer',
                "group"=>"system",
                'children' => [
                    'language'=>[
                        'url'        => 'admin/module/language',
                        'title'      => __('Languages'),
                        'icon'       => 'icon ion-ios-globe',
                        'permission' => 'language_manage',
                    ],
                    'translations'=>[
                        'url'        => 'admin/module/language/translations',
                        'title'      => __("Translation Manager"),
                        'icon'       => 'icon ion-ios-globe',
                        'permission' => 'language_translation',
                    ],
                    'logs'=>[
                        'url'        => 'admin/logs',
                        'title'      => __("System Logs"),
                        'icon'       => 'icon ion-ios-nuclear',
                        'permission' => 'system_log_view',
                    ],
                ]
            ],
        ];
        foreach (SettingManager::zones() as $id=>$zone){
            $zone['url'] = route('core.admin.setting.zone',['zone_id'=>$id]);
            $menus['setting_'.$id] = $zone;
        }
        return $menus;
    }

    public function registerAdvanceSetting(){
        return [
            'id'   => 'advance',
            'title' => __("Advance Settings"),
            'position'=>80,
            'view'      => "Core::admin.settings.groups.advance",
            "keys"      => [
                'map_provider',
                'map_gmap_key',
                'google_client_secret',
                'google_client_id',
                'google_enable',
                'facebook_client_secret',
                'facebook_client_id',
                'facebook_enable',
                'twitter_enable',
                'twitter_client_id',
                'twitter_client_secret',
                'recaptcha_enable',
                'recaptcha_api_key',
                'recaptcha_api_secret',
                'head_scripts',
                'body_scripts',
                'footer_scripts',
                'size_unit',

                'cookie_agreement_enable',
                'cookie_agreement_button_text',
                'cookie_agreement_content',

                'broadcast_driver',
                'pusher_api_key',
                'pusher_api_secret',
                'pusher_app_id',
                'pusher_cluster',
            ],
            'filter_demo_mode'=>[
                'head_scripts',
                'body_scripts',
                'footer_scripts',
                'cookie_agreement_content',
                'cookie_agreement_button_text',
            ]
        ];
    }
    public function registerStyleSetting(){
        return [

            'id'   => 'style',
            'title' => __("Style Settings"),
            'position'=>70,
            'keys'=>[
                'enable_preloader',
                'style_main_color',
                'style_custom_css',
                'style_typo',
            ],
            'filter_demo_mode'=>[
                'style_custom_css',
                'style_typo',
            ]
        ];
    }
    public function registerGeneralSetting(){
        return [

            'title' => __("General Settings"),
            'position'=>20,
            'keys'=>[
                'site_title',
                'site_desc',
                'site_favicon',
                'home_page_id',
                'date_format',
                'site_timezone',
                'site_locale',
                'site_first_day_of_the_weekin_calendar',
                'site_enable_multi_lang',
                'enable_rtl',
                'enable_preloader',
                'terms_and_conditions_id',
            ],
            'filter_demo_mode'=>[
                'home_page_id',
                'admin_email',
                'email_from_name',
                'email_from_address',
                'site_title',
                'site_desc',
            ]
        ];
    }
    public function registerMobileSetting(){
        return [
            'title' => __("Mobile Settings"),
            'view'      => "Core::admin.settings.groups.mobile",
            'position'=>90,
            "keys"=>[]
        ];
    }

}

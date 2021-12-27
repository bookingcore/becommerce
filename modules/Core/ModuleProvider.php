<?php
namespace Modules\Core;
use Illuminate\Support\Facades\Event;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\CreateReviewEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Helpers\SettingManager;
use Modules\Core\Helpers\SitemapHelper;
use Modules\Core\Listeners\CreatedServicesListen;
use Modules\Core\Listeners\CreateReviewListen;
use Modules\Core\Listeners\UpdatedServicesListen;
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
        $this->app->singleton(SitemapHelper::class,function($app){
            return new SitemapHelper();
        });
    }


    public static function getAdminSubmenu()
    {
        return [
            [
                'id'=>'plugin',
                'parent'=>'tools',
                'title'=>__("Plugins"),
                'url'=>'admin/module/core/plugins',
                'icon'=>'icon ion-md-color-wand',
                'permission'=>'setting_manage'
            ]
        ];
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
                'phone_contact',
                'home_page_id',
                'logo_id',
                'logo_white_id',
                'footer_style',
                'copyright',
                'footer_socials',
                'footer_info_text',
                'list_widget_footer',
                'date_format',
                'site_timezone',
                'site_locale',
                'site_first_day_of_the_weekin_calendar',
                'site_enable_multi_lang',
                'enable_rtl',
                'page_contact_lists',
                'page_contact_iframe_google_map',
                'contact_call_to_action_title',
                'contact_call_to_action_sub_title',
                'contact_call_to_action_button_text',
                'contact_call_to_action_button_link',
                'contact_call_to_action_image',
                'enable_preloader',
                'terms_and_conditions_id',
            ],
            'filter_demo_mode'=>[
                'home_page_id',
                'admin_email',
                'email_from_name',
                'email_from_address',
                'footer_text_left',
                'footer_text_right',
                'site_title',
                'site_desc',
                'logo_id',
            ]
        ];
    }
}

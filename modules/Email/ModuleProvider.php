<?php


namespace Modules\Email;


use Illuminate\Mail\MailManager;
use Illuminate\Support\Facades\Artisan;
use Modules\Core\Helpers\SettingManager;
use Modules\Email\Plugins\CssInlinerPlugin;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->app->singleton(CssInlinerPlugin::class, function ($app) {
            return new CssInlinerPlugin();
        });

        $this->app->afterResolving('mail.manager', function (MailManager $mailManager) {
            $mailManager->getSwiftMailer()->registerPlugin($this->app->make(CssInlinerPlugin::class));
            return $mailManager;
        });

        SettingManager::register("email",[$this,'getEmailSettings']);
    }
    public function register()
    {

        $this->app->register(RouterServiceProvider::class);

    }

    public function getEmailSettings(){
        $settings =  [
            'id'   => 'email',
            'title' => __("Email Settings"),
            'position'=> 35,
            'view'=>"Email::admin.settings.email",
            'keys' => [

                'email_driver',
                'email_host',
                'email_port',
                'email_encryption',
                'email_username',
                'email_password',
                'email_mailgun_domain',
                'email_mailgun_secret',
                'email_mailgun_endpoint',
                'email_postmark_token',
                'email_ses_key',
                'email_ses_secret',
                'email_ses_region',
                'email_sparkpost_secret',

                'admin_email',
                'email_from_name',
                'email_from_address',

            ],
            'translation_keys'=>[
                'email_c_new_order_subject',

                // For Admin
                'email_a_new_order_subject',

                // For Vendor
                'email_v_new_order_subject',
            ],
            'html_keys' => [

            ],
            'after_saving'=>[$this,'queueRestart']
        ];

        $types = [
            'new'=>[
                'default'=>__('Thanks for shopping with us')
            ],
            'completed'=>[
                'default'=>__('Completed Order')
            ],
            'cancelled'=>[
                'default'=>__('Cancelled Order')
            ],
            'refunded'=>[
                'default'=>__('Refunded Order')
            ],
        ];
        foreach ($types as $type_id=>$configs){
            $settings['key'][] = 'email_c_'.$type_id.'_order_enable';
            $settings['key'][] = 'email_c_'.$type_id.'_order_subject';
            $settings['key'][] = 'email_v_'.$type_id.'_order_enable';
            $settings['key'][] = 'email_v_'.$type_id.'_order_subject';
            $settings['key'][] = 'email_a_'.$type_id.'_order_enable';
            $settings['key'][] = 'email_a_'.$type_id.'_order_subject';

            $settings['translation_keys'][] = 'email_c_'.$type_id.'_order_subject';
            $settings['translation_keys'][] = 'email_v_'.$type_id.'_order_subject';
            $settings['translation_keys'][] = 'email_a_'.$type_id.'_order_subject';
        }
        return $settings;
    }

    public function queueRestart(){
        Artisan::call('queue:restart');
    }
}

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
        return [
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


                // For Customer
                'email_c_new_order_enable',
                'email_c_new_order_subject',


                // For Admin
                'email_a_new_order_enable',
                'email_a_new_order_recipient',
                'email_a_new_order_subject',

                // For Vendor
                'email_v_new_order_enable',
                'email_v_new_order_subject',

                'email_cancelled_order_enable',
                'email_cancelled_order_recipient',
                'email_cancelled_order_subject',

                'email_failed_order_enable',
                'email_failed_order_recipient',
                'email_failed_order_subject',

                'email_order_on_hold_enable',
                'email_order_on_hold_subject',

                'email_processing_order_enable',
                'email_processing_order_subject',

                'email_completed_order_enable',
                'email_completed_order_subject',

                'email_refunded_order_enable',
                'email_refunded_order_subject',

                'email_customer_invoice_enable',
                'email_customer_invoice_subject',
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
    }

    public function queueRestart(){
        Artisan::call('queue:restart');
    }
}

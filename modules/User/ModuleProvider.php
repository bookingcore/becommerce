<?php
namespace Modules\User;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SettingManager;
use Modules\ModuleServiceProvider;
use Modules\User\Models\Plan;
use Modules\Vendor\Models\VendorRequest;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        Blade::directive('has_permission', function ($expression) {
            return "<?php if(auth()->user()->hasPermission({$expression})): ?>";
        });
        Blade::directive('end_has_permission', function ($expression) {
            return "<?php endif; ?>";
        });

        SettingManager::register("user",[$this,'getUserSettings']);

        AdminMenuManager::register("user",[$this,'getAdminMenu']);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    public static function getBookableServices()
    {
        return ['plan'=>Plan::class];
    }

    public static function getAdminMenu()
    {
        $noti_verify = User::countVerifyRequest();
        $noti = $noti_verify;

        $options = [
            "position"=>70,
            'url'        => route('user.admin.index'),
            'title'      => __('Users :count',['count'=>$noti ? sprintf('<span class="badge badge-warning">%d</span>',$noti) : '']),
            'icon'       => 'icon ion-ios-contacts',
            'permission' => 'user_manage',
            'children'   => [
                'user'=>[
                    'url'   => route('user.admin.index'),
                    'title' => __('All Users'),
                    'icon'  => 'fa fa-user',
                ],
                'plan'=>[
                    "position"=>50,
                    'url'        => route('user.admin.plan.index'),
                    'title'      => __('User Plans'),
                    'icon'       => 'icon ion-ios-contacts',
                    'permission' => 'user_manage',
                ],
                'role'=>[
                    'url'        => route('user.admin.role.index'),
                    'title'      => __('Role Manager'),
                    'permission' => 'role_manage',
                    'icon'       => 'fa fa-lock',
                ],
                'subscriber'=>[
                    'url'        => route('user.admin.subscriber.index'),
                    'title'      => __('Subscribers'),
                    'permission' => 'newsletter_manage',
                ],
                'contact'=>[
                    'url'        => route('contact.admin.index'),
                    'title'      => __('Contact'),
                    'icon'       => 'fa fa-envelope',
                    'permission' => 'contact_manage',
                ]
            ]
        ];
        return [
            'user'=> $options,
        ];
    }
    public static function getUserMenu()
    {
        /**
         * @var $user User
         */
        $res = [];
        $user = Auth::user();

        $is_wallet_module_disable = setting_item('wallet_module_disable');
        if(empty($is_wallet_module_disable))
        {
            $res['wallet']= [
                'position'   => 27,
                'icon'       => 'fa fa-money',
                'url'        => route('user.wallet'),
                'title'      => __("My Wallet"),
            ];
        }

        $res['enquiry']= [
            'position'   => 37,
            'icon'       => 'icofont-ebook',
            'url'        => route('vendor.enquiry_report'),
            'title'      => __("Enquiry Report"),
            'permission' => 'enquiry_view',
        ];

        if(setting_item('inbox_enable')) {
            $res['chat'] = [
                'position' => 20,
                'icon' => 'fa fa-comments',
                'url' => route('user.chat'),
                'title' => __("Messages"),
            ];
        }

        return $res;
    }
    public function getUserSettings(){
        return [

            'id'   => 'user',
            'title' => __("User Settings"),
            'position'=>50,
            'view'=>"User::admin.settings.user",
            "keys"=>[
                'user_enable_login_recaptcha',
                'user_enable_register_recaptcha',
                'enable_mail_user_registered',
                'user_content_email_registered',
                'admin_enable_mail_user_registered',
                'admin_content_email_user_registered',
                'user_content_email_forget_password',
                'inbox_enable',
                'subject_email_verify_register_user',
                'content_email_verify_register_user',
                'enable_verify_email_register_user',
            ],
            'html_keys'=>[

            ]
        ];
    }
}

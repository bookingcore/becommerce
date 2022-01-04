<?php
namespace Modules\Product;
use Modules\Core\Helpers\SettingManager;
use Modules\ModuleServiceProvider;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductExternal;
use Modules\Product\Models\ProductVariation;
use Modules\Template\BlockManager;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        SettingManager::register("product",[$this,'getProductSettings']);
        SettingManager::register("store",[$this,'getStoreSettings']);
        SettingManager::register("shipping",[$this,'getShippingSettings']);
        SettingManager::register("tax",[$this,'getTaxSettings']);
        SettingManager::register("email",[$this,'getEmailSettings']);

        BlockManager::register("slide_product",\Modules\Product\Blocks\SlideProduct::class);
        BlockManager::register("list_product_categories",\Modules\Product\Blocks\ListProductCategories::class);

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
            'product'=>[
                "position"=>40,
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
                    'category'=>[
                        'url'        => 'admin/module/product/category',
                        'title'      => __('Categories'),
                        'permission' => 'product_manage_others',
                    ],
                    'tag'=>[
                        'url'        => 'admin/module/product/tag',
                        'title'      => __('Tags'),
                        'permission' => 'product_manage_others',
                    ],
                    'brand'=>[
	                    'url'        => route('product.admin.brand.index'),
	                    'title'      => __('Brand'),
	                    'permission' => 'product_manage_others',
                    ],
                    'attribute'=>[
                        'url'        => 'admin/module/product/attribute',
                        'title'      => __('Attributes'),
                        'permission' => 'product_manage_attributes',
                    ],
                ]
            ],
            'coupon'=>[
                'url'        => 'admin/module/product/coupon',
                'title'      => __('Coupons'),
                'permission' => 'product_manage_others',
                "position"=>42,
                'icon'       => 'icon ion-ios-barcode',
                'children'=>[
                    'coupon'=>[
                        'url'        => 'admin/module/product/coupon',
                        'title'      => __('All Coupons'),
                        'permission' => 'product_manage_others',
                    ],
                    'coupon_create'=>[
                        'url'        => 'admin/module/product/coupon/create',
                        'title'      => __('Add New Coupon'),
                        'permission' => 'product_manage_others',
                    ],
                ]
            ]
        ];
    }

    public static function getMenuBuilderTypes()
    {
        return [
            'product'=>[
                'class' => Product::class,
                'name'  => __("Products"),
                'items' => Product::searchForMenu(),
                'position'=>41
            ],
            'product_cat'=>[
                'class' => ProductCategory::class,
                'name'  => __("Product Categories"),
                'items' => ProductCategory::searchForMenu(),
                'position'=>42
            ],
            'product_brand'=>[
                'class' => ProductBrand::class,
                'name'  => __("Product Brands"),
                'items' => ProductBrand::searchForMenu(),
                'position'=>42
            ],
        ];
    }

    public static function getBookableServices()
    {
        return [
            'product' => Product::class,
        ];
    }
    public static function getProductTypes()
    {
        return [
            'simple'=>Product::class,
            'variable'=>ProductVariation::class,
            'external'=>ProductExternal::class,
        ];
    }

    public static function getAdminProductTabs(){
        return [
            "general"=>[
                'position'=>10,
                "icon"=>"fa fa-home",
                "title"=>__("General"),
                "view"=>"Product::admin.product.general"
            ],
            "external"=>[
                'position'=>15,
                "icon"=>"fa fa-external-link",
                "title"=>__("External"),
                "view"=>"Product::admin.product.external",
                "hide_in_sub_language"=>1,
                "condition"=>"product_type:is(external)",
            ],
            "pricing"=>[
                'position'=>20,
                "icon"=>"fa fa-money",
                "title"=>__("Pricing"),
                "view"=>"Product::admin.product.pricing",
                "hide_in_sub_language"=>1
            ],
            "inventory"=>[
                'position'=>30,
                "icon"=>"fa fa-archive",
                "title"=>__("Inventory"),
                "view"=>"Product::admin.product.inventory",
                "hide_in_sub_language"=>1
            ],
            "categories"=>[
                'position'=>40,
                "icon"=>"fa fa-book",
                "title"=>__("Categories"),
                "view"=>"Product::admin.product.categories",
                "hide_in_sub_language"=>1
            ],
            "attributes"=>[
                'position'=>50,
                "icon"=>"fa fa-bars",
                "title"=>__("Attributes"),
                "view"=>"Product::admin.product.attributes",
                "hide_in_sub_language"=>1
            ],
            "variations"=>[
                'position'=>60,
                "icon"=>"fa fa-bars",
                "title"=>__("Variations"),
                "view"=>"Product::admin.product.variations",
                "condition"=>"product_type:is(variable)",
                "hide_in_sub_language"=>1
            ],
            "seo"=>[
                'position'=>70,
                "icon"=>"fa fa-flag",
                "title"=>__("SEO"),
                "view"=>"Core::admin.seo-meta.seo-meta"
            ],

        ];
    }

    public static function getTemplateBlocks(){
        return [
            'ListProduct'=>"\\Modules\\Product\\Blocks\\ListProduct",
            'ListCategories'=>"\\Modules\\Product\\Blocks\\ListCategories",
            'ListProductInCategories'=>"\\Modules\\Product\\Blocks\\ListProductInCategories",
            'RecentlyViewedProducts'=>"\\Modules\\Product\\Blocks\\RecentlyViewedProducts",
        ];
    }
    public static function getUserMenu()
    {
        $res = [];

        $res['orders'] = [
            'url'   => route('user.orders.index'),
            'title'      => __("Manage Orders"),
            'position'   => 30,
            'icon'=>'fa fa-shopping-bag'
        ];
        $res['product'] = [
            'url'   => route('product.vendor.index'),
            'title'      => __("Manage Products"),
            'position'   => 33,
            'permission' => 'product_view',
            'icon'=>'fa fa-cubes',
            'children' => [
                [
                    'url'   => route('product.vendor.index'),
                    'title'  => __("All Products"),
                ],
                [
                    'url'   => route('product.vendor.create'),
                    'title'      => __("Add Product"),
                    'permission' => 'product_create',
                ],
                'products_order' => [
                    'url'      => route('product.vendor.orders'),
                    'title'    => __("Orders"),
                    'permission' => 'product_create',
                    'position' => 21
                ],
            ]
        ];
        return $res;
    }

    public function getProductSettings(){
        return [
            'id'   => 'product',
            'title' => __("Product Settings"),
            'position'=>32,
            'view'=>"Product::admin.settings.product",
            "keys"=>[
                'product_page_search_title',
                'products_per_page',
                'product_page_list_seo_title',
                'product_page_list_seo_desc',
                'product_page_list_seo_image',
                'product_page_list_seo_share',

                'product_enable_review',
                'product_review_approved',
                'product_review_verification_required',
                'product_review_number_per_page',

                'product_enable_stock_management',
                'product_hold_stock',
                'product_hide_products_out_of_stock',

                'product_booking_buyer_fees',
                'product_policies',
                'shipping_information',
                'ads_url',
                'ads_image',
                'product_sidebar',
                'list_sliders'
            ],
            'html_keys'=>[

            ]
        ];
    }

    public function getStoreSettings(){
        return [
            'id'   => 'store',
            'title' => __("Store Settings"),
            'position'=>31,
            'view'=>"Product::admin.settings.store",
            'keys' => [
                'store_address',
                'store_city',
                'store_country',
                'store_postcode'
            ],
            'html_keys' => [

            ]
        ];
    }

    public function getShippingSettings(){
        return [
            'id'   => 'shipping',
            'title' => __("Shipping Settings"),
            'position'=>33,
            'view'=>"Product::admin.settings.shipping",
            'keys' => [
                'shipping_enable_calc',
                'shipping_cost_requires_address'
            ],
            'html_keys' => [

            ]
        ];
    }

    public function getTaxSettings(){
        return [
            'id'   => 'tax',
            'title' => __("Tax Settings"),
            'position'=>34,
            'view'=>"Product::admin.settings.tax",
            'keys' => [

            ],
            'html_keys' => [

            ]
        ];
    }

    public function getEmailSettings(){
        return [
            'id'   => 'email',
            'title' => __("Email Settings"),
            'position'=> 35,
            'view'=>"Product::admin.settings.email",
            'keys' => [
                'email_new_order_enable',
                'email_new_order_recipient',
                'email_new_order_subject',

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
            'html_keys' => [

            ]
        ];
    }
}

<?php
namespace Modules\Product;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SettingManager;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductExternal;
use Modules\Product\Models\ProductVariation;
use Modules\Template\BlockManager;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->mergeConfigFrom(__DIR__.'/Configs/product.php','product');

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $sitemapHelper->add("product",[Product::class,"getForSitemap"]);

        AdminMenuManager::register("product",[$this,'getAdminMenu']);
        AdminMenuManager::register_group('catalog',__('Catalog'));

        SettingManager::register("product",[$this,'getProductSettings']);
        SettingManager::register("store",[$this,'getStoreSettings']);
        SettingManager::register("shipping",[$this,'getShippingSettings']);
        SettingManager::register("tax",[$this,'getTaxSettings']);

        BlockManager::register("list_product",\Modules\Product\Blocks\ListProduct::class);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        $count_pending = Product::query()->where('status','pending')->count('id');
        return [
            'product'=>[
                "position"=>30,
                'url'        => route('product.admin.index'),
                'title'      => __('Products :count',['count'=>$count_pending ? '<span class="badge badge-warning">'.$count_pending.'</span>' : '']),
                'icon'       => 'icon ion-ios-cart',
                'permission' => 'product_view',
                'group'=>'catalog',
                'children'   => [
                    'add'=>[
                        'url'        => route('product.admin.index'),
                        'title'      => __('All Products'),
                        'permission' => 'product_view',
                    ],
                    'create'=>[
                        'url'        => route('product.admin.create'),
                        'title'      => __('Add new Product'),
                        'permission' => 'product_create',
                    ],
                    'category'=>[
                        'url'        => route('product.admin.category.index'),
                        'title'      => __('Categories'),
                        'permission' => 'product_manage_others',
                    ],
                    'tag'=>[
                        'url'        => route('product.admin.tag.index'),
                        'title'      => __('Tags'),
                        'permission' => 'product_manage_others',
                    ],
                    'brand'=>[
	                    'url'        => route('product.admin.brand.index'),
	                    'title'      => __('Brand'),
	                    'permission' => 'product_manage_others',
                    ],
                    'attribute'=>[
                        'url'        => route('product.admin.attribute.index'),
                        'title'      => __('Attributes'),
                        'permission' => 'product_manage_attributes',
                    ],
                ]
            ],
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
            "pricing"=>[
                'position'=>10,
                "icon"=>"fa fa-money",
                "title"=>__("Pricing"),
                "view"=>"Product::admin.product.pricing",
                "hide_in_sub_language"=>1
            ],
            "external"=>[
                'position'=>20,
                "icon"=>"fa fa-external-link",
                "title"=>__("External"),
                "view"=>"Product::admin.product.external",
                "hide_in_sub_language"=>1,
                "condition"=>"product_type:is(external)",
            ],
            "inventory"=>[
                'position'=>30,
                "icon"=>"fa fa-archive",
                "title"=>__("Inventory"),
                "view"=>"Product::admin.product.inventory",
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

    public function getProductSettings(){
        return [
            'id'   => 'product',
            'title' => __("Product Settings"),
            'position'=>32,
            'view'=>"Product::admin.settings.product",
            "keys"=>[
                'product_page_search_title',
                'product_per_page',
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

                'product_policies',
                'product_sidebar',
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
                'store_postcode',
                'guest_checkout'
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
                'tax_enable_calc',
                'tax_prices_include_tax',
                'tax_shipping_tax_class',
                'tax_round_at_subtotal',
                'tax_classes',
                'tax_display_shop',
                'tax_display_cart',
                'tax_price_display_suffix',
                'tax_total_display'
            ],
            'html_keys' => [

            ]
        ];
    }
}

<?php
namespace Modules\Product;
use Modules\ModuleServiceProvider;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Models\Space;
use Modules\Product\Models\VariableProduct;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

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
                "position"=>41,
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
                    'coupon'=>[
                        'url'        => 'admin/module/product/coupon',
                        'title'      => __('All Coupon'),
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
            "pricing"=>[
                'position'=>20,
                "icon"=>"fa fa-money",
                "title"=>__("Pricing"),
                "view"=>"Product::admin.product.pricing",
                "hide_in_sub_language"=>1
            ],
            "inventory"=>[
                'position'=>30,
                "icon"=>"fa fa-money",
                "title"=>__("Inventory"),
                "view"=>"Product::admin.product.inventory",
                "hide_in_sub_language"=>1
            ],
            "categories"=>[
                'position'=>40,
                "icon"=>"fa fa-money",
                "title"=>__("Categories"),
                "view"=>"Product::admin.product.categories",
                "hide_in_sub_language"=>1
            ],
            "attributes"=>[
                'position'=>50,
                "icon"=>"fa fa-money",
                "title"=>__("Attributes"),
                "view"=>"Product::admin.product.attributes",
                "hide_in_sub_language"=>1
            ],
            "variations"=>[
                'position'=>60,
                "icon"=>"fa fa-money",
                "title"=>__("Variations"),
                "view"=>"Product::admin.product.variations",
                "condition"=>"product_type:is(variable)",
                "hide_in_sub_language"=>1
            ],
            "seo"=>[
                'position'=>70,
                "icon"=>"fa fa-money",
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
}

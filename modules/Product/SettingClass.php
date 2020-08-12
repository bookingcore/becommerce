<?php

namespace  Modules\Product;

use Modules\Core\Abstracts\BaseSettingsClass;
use Modules\Core\Models\Settings;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'product',
                'title' => __("Product Settings"),
                'position'=>20,
                'view'=>"Product::admin.settings.product",
                "keys"=>[
                    'product_page_search_title',
                    'product_page_search_banner',
                    'product_layout_search',
                    'product_location_search_style',

                    'product_enable_review',
                    'product_review_approved',
                    'product_enable_review_after_booking',
                    'product_review_number_per_page',
                    'product_review_stats',

                    'product_page_list_seo_title',
                    'product_page_list_seo_desc',
                    'product_page_list_seo_image',
                    'product_page_list_seo_share',

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
            ]
        ];
    }
}

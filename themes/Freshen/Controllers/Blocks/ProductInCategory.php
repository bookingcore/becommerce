<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Media\Helpers\FileHelper;

class ProductInCategory extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'value' => 'style_1',
                    'values' => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ]
                    ],
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'      => 'category_id',
                    'type'    => 'select2',
                    'label'   => __('Select Categories'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => route("product.admin.category.getForSelect2"),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'multiple' => false,
                        'placeholder' => __('-- Select --')
                    ],
                    'pre_selected'=>route("product.admin.category.getForSelect2",['pre_selected'=>"1"])
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
                ],
                [
                    'id'            => 'order',
                    'type'          => 'select',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'id'   => 'id',
                            'name' => __("Date Create")
                        ],
                        [
                            'id'   => 'title',
                            'name' => __("Title")
                        ],
                        [
                            'id'   => 'rate',
                            'name' => __("Rate")
                        ],
                    ],
                    "selectOptions"=> [
                        'hideNoneSelectedText' => "true"
                    ]
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'select',
                    'label'         => __('Order By'),
                    'values'        => [
                        [
                            'id'   => 'asc',
                            'name' => __("ASC")
                        ],
                        [
                            'id'   => 'desc',
                            'name' => __("DESC")
                        ],
                    ],
                    "selectOptions"=> [
                        'hideNoneSelectedText' => "true"
                    ]
                ],
                [
                    'id' => 'load_more_url',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Load More Url"),
                ],
                [
                    'id' => 'load_more_name',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Load More Name"),
                ],
                [
                    'id'    => 'bg_image',
                    'type'  => 'uploader',
                    'label' => __('Background Image Uploader')
                ],
                [
                    'id' => 'bg_title',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Background Title"),
                ],
                [
                    'id' => 'bg_sub_title',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Background Sub Title"),
                ],
                [
                    'id'        => 'link_apply',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Background Button Name'),
                ],
                [
                    'id'        => 'url_apply',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Background Button Url'),
                ],
                [
                    'id'        => 'text_class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Text Color Class'),
                ],
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Product: In Category');
    }

    public function content($model = [])
    {
        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $model['limit'] = $model['number'] ?? 5;
        $list = Product::search($model)->paginate($model['limit']);

        $data = [
            'rows'       => $list,
            'title'      => $model['title'] ?? "",
            'categories' => $categories ?? [],
            'style_list' => !empty($model['style']) ? $model['style'] : "normal",
            'bg_title' => $model['bg_title'] ?? "",
            'bg_sub_title' => $model['bg_sub_title'] ?? "",
            'link_apply' => $model['link_apply'] ?? "",
            'url_apply' => $model['url_apply'] ?? "",
            'load_more_url' => $model['load_more_url'] ?? "",
            'load_more_name' => $model['load_more_name'] ?? "",
            'text_class' => $model['text_class'] ?? "",
            'bg_image_url' => !empty($model['bg_image']) ? FileHelper::url($model['bg_image'], 'full') : "",
        ];
        $style = $model['style'] ?? 'style_1';

        return view("blocks.product-in-category.{$style}", $data);
    }
}

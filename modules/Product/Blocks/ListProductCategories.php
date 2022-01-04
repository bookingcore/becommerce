<?php
namespace Modules\Product\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategoryRelation;

class ListProductCategories extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'      => 'category_id',
                    'type'    => 'select2',
                    'label'   => __('Filter by Category'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => route("product.admin.category.getForSelect2"),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'multiple' => '1',
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
                    'id'        => 'link_all',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link view all')
                ],
                [
                    'id'          => 'sliders',
                    'type'        => 'listItem',
                    'label'       => __('Slider (Don\'t use sliders for the default theme)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Link')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Slider')
                        ],
                    ]
                ],
                [
                    'id'          => 'custom_link',
                    'type'        => 'listItem',
                    'label'       => __('Custom Link (Don\'t use custom link for the default theme)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Link')
                        ]
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Product: List Items In Categories');
    }

    public function content($model = [])
    {
        $product = new Product();
        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $model['limit'] = $model['number'] ?? 5;
        $list = $product->search($model);

        $data = [
            'rows'       => $list,
            'title'      => $model['title'] ?? "",
            'sliders'    => $model['sliders'] ?? '',
            'custom_link'=> $model['custom_link'] ?? '',
            'link_all'   => $model['link_all'] ?? ''
        ];
        return view('Product::frontend.blocks.list-product-categories.index', $data);
    }
}

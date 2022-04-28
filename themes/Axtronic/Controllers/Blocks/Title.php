<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/27/2022
 * Time: 8:03 PM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Title extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'style_list',
                    'type'          => 'radios',
                    'label'         => __('Style Item'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style Normal"),
                        ],
                        [
                            'value'   => 'slide',
                            'name' => __("Style Slide")
                        ],
                        [
                            'value'   => 'normal_bg',
                            'name' => __("Style normal with Background")
                        ],
                        [
                            'value'   => 'slide_bg',
                            'name' => __("Style Slide with Background")
                        ],
                        [
                            'value'   => 'grid',
                            'name' => __("Style Grid"),
                        ],
                    ]
                ],
                [
                    'id'            => 'style_header',
                    'type'          => 'radios',
                    'label'         => __('Title style'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1"),
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("Style 3")
                        ],
                    ]
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'      => 'cat_ids',
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
                    'type'=> "checkbox",
                    'label'=>__("Only featured items?"),
                    'id'=> "is_featured",
                    'default'=>true
                ],
                [
                    'id'    => 'bg_content',
                    'type'  => 'uploader',
                    'label' => __('Background image')
                ],
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Product: List item');
    }

    public function content($model = [])
    {

        return view('blocks.title.index',$model);
    }
}

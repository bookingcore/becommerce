<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/5/2022
 * Time: 8:26 AM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Template\Blocks\BaseBlock;

class ProductFeature extends BaseBlock
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
                            'value'   => '',
                            'name' => __("Gird")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Normal")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("Slider")
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
                    'id'            => 'style_header',
                    'type'          => 'radios',
                    'label'         => __('Position Title'),
                    'values'        => [
                        [
                            'value'   => 'justify-content-start',
                            'name' => __("Left"),
                        ],
                        [
                            'value'   => 'justify-content-center',
                            'name' => __("Center")
                        ],
                        [
                            'value'   => 'justify-content-end',
                            'name' => __("Right")
                        ],
                    ]
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Color title dark?"),
                    'id'=> "is_dark",
                    'default'=>false
                ],
                [
                    'id'        => 'title_content',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title Content'),
                    'conditions' => ['style' => '']
                ],
                [
                    'id'        => 'content',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Content'),
                    'conditions' => ['style' => '']
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
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
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
                [
                    'id'    => 'bg_color',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label' => __('Background Color')
                ],
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Feature Product ');
    }

    public function content($model = [])
    {

        $model['order'] = $model['order'] ?? "id";
        $model['order_by'] = $model['order_by'] ?? "desc";
        $model['is_featured'] = true;
        $model['limit'] = $model['number'] ?? 7;
        $list = Product::search($model)->paginate($model['limit']);
        $data = [
            'rows'          => $list,
            'title'         => $model['title'] ?? "",
            'bg_content'    => $model['bg_content'] ?? '',
            'style_header'  => !empty($model['style_header']) ? $model['style_header'] : "",
            'is_dark'       => $model['is_dark'] ?? false,
            'bg_color'      => $model['bg_color'],
            'title_content' => $model['title_content'],
            'content'       => $model['content'],
            'width_style'       => $model['width_style'] ?? "container",
        ];
        $style = $model['style'] ? $model['style'] : 'index';
        return view("blocks.feature-product.{$style}", $data);
    }
}

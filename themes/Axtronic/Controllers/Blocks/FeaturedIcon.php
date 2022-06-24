<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/22/2022
 * Time: 11:20 AM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class FeaturedIcon extends BaseBlock
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
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ]
                    ],
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Banner Image (With Style 2) ')
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('Fee List Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'    => 'icon',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label' => __('Class Icon')
                        ],
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Featured Icon 2');
    }

    public function content($model = [])
    {
        $style = $model['style'] ? $model['style'] : 'index';
        return view("blocks.featured-icon.{$style}", $model);
    }
}

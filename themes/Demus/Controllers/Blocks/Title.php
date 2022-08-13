<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/22/2022
 * Time: 4:40 PM
 */

namespace Themes\Demus\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Title extends BaseBlock
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
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'std'   => 'style_1',
                    'values' => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style width Image")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style width Background")
                        ]
                    ],
                ],
                [
                    'type'      => "checkbox",
                    'label'     =>__("Color title dark?"),
                    'id'        => "is_dark",
                    'default'   => true
                ],
                [
                    'id'        => 'title_content',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title Content'),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'        => 'sub_title_content',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title Content'),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Upload Image '),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'        => 'bg_color',
                    'type'      => 'input',
                    'inputType' => 'color',
                    'label'     => __('Background Color'),
                    'conditions' => ['style' => 'style_2']
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Background Image '),
                    'conditions' => ['style' => 'style_2']
                ],
                [
                    'id'        => 'text_url',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Text For Button'),
                    'conditions' => ['style' => 'style_2']
                ],
                [
                    'id'        => 'url',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link For Button'),
                    'conditions' => ['style' => 'style_2']
                ],

            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Title');
    }

    public function content($model = [])
    {
        return view("blocks.title.".$model['style'], $model);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/6/2022
 * Time: 8:37 PM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class Testimonial extends BaseBlock
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
                    'type'      => "checkbox",
                    'label'     =>__("Color title dark?"),
                    'id'        => "is_dark",
                    'default'   =>false
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style item '),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1")
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
                    'id'        => 'bg_color',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Background Color')
                ],
                [
                    'id'          => 'list_testimonial',
                    'type'        => 'listItem',
                    'label'       => __('Testimonial List Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title_item',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title Item')
                        ],
                        [
                            'id'        => 'job',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Job')
                        ],
                        [
                            'id'        => 'content',
                            'type'      => 'textArea',
                            'inputType' => 'textArea',
                            'label'     => __('Content')
                        ],
                        [
                            'id'        => 'number_star',
                            'type'      => 'input',
                            'inputType' => 'number',
                            'label'     => __('Number star')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Avatar')
                        ],
                    ]
                ],

            ]
        ]);
    }

    public function getName()
    {
        return __('Testimonial');
    }

    public function content($model = [])
    {
        return view('blocks.testimonial.index', $model);
    }
}

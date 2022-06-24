<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Promotion extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [      'id'        => 'title',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Title')
                ],
                [      'id'        => 'sub_title',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Sub Title')
                ],
                [
                    'id'            => 'col',
                    'type'          => 'radios',
                    'label'         => __('Item Per Rows ( default 3 item in row)'),
                    'values'        => [
                        [
                            'value'   => '6',
                            'name' => __("2 Item")
                        ],
                        [
                            'value'   => '4',
                            'name' => __("3 Item")
                        ],
                        [
                            'value'   => '3',
                            'name' => __("4 Item")
                        ],
                        [
                            'value'   => 'grid',
                            'name' => __("Gird")
                        ]
                    ]
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ],
                    ]
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'List Item',
                    'settings'    => [
                        [      'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Sub Title')
                        ],
                        [      'id'        => 'title',
                               'type'      => 'input',
                               'inputType' => 'text',
                               'label'     => __('Title')
                        ],
                        [
                            'id'        => 'content',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Content')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link Product')
                        ],
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'id'            => 'position',
                            'type'          => 'select',
                            'label'         => __('Position'),
                            'values'        => [
                                [
                                    'id'   => 'top_left',
                                    'name' => __("Top Left")
                                ],
                                [
                                    'id'   => 'top_right',
                                    'name' => __("Top Right")
                                ],
                                [
                                    'id'   => 'bottom_left',
                                    'name' => __("Bottom Left")
                                ],
                                [
                                    'id'   => 'bottom_right',
                                    'name' => __("Right Left")
                                ],
                                [
                                    'id'   => 'center_right',
                                    'name' => __("Right Center")
                                ],
                                [
                                    'id'   => 'center_left',
                                    'name' => __("Left center")
                                ]
                            ],
                            "selectOptions"=> [
                                'hideNoneSelectedText' => "true"
                            ]
                        ],
                        [
                            'id'            => 'style_color',
                            'type'          => 'select',
                            'label'         => __('Color Text'),
                            'values'        => [
                                [
                                    'id'   => 'dark',
                                    'name' => __("Dark")
                                ],
                                [
                                    'id'   => 'light',
                                    'name' => __("Light")
                                ],
                            ],
                            "selectOptions"=> [
                                'hideNoneSelectedText' => "true"
                            ]
                        ],
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Promotion');
    }

    public function content($model = [])
    {
        if (empty($model['style'])) {
            $model['style'] = 'index';
        }
        if (empty($model['position'])) {
            $model['position'] = 'top_left';
        }
        $data = [
            'title'  =>  $model['title'] ?? '',
            'sub_title'  =>  $model['sub_title'] ?? '',
            'list_items'  =>  $model['list_items'] ?? '',
            'col' => $model['col'] ?? 3,
            'style_color' => $model['style_color'] ?? 'light',
        ];
        return view('blocks.promotion.'.$model['style'], $data);
    }
}

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
                        ]
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
                            'type'      => "checkbox",
                            'label'     =>__("Color title dark?"),
                            'id'        => "is_dark",
                            'default'   => false
                        ],
                        [
                            'id'            => 'position',
                            'type'          => 'select',
                            'label'         => __('Position'),
                            'values'        => [
                                [
                                    'id'   => 'left',
                                    'name' => __("Left")
                                ],
                                [
                                    'id'   => 'right',
                                    'name' => __("Right")
                                ],
                                [
                                    'id'   => 'center',
                                    'name' => __("Center")
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
            'title'         =>  $model['title'] ?? '',
            'sub_title'     =>  $model['sub_title'] ?? '',
            'list_items'    =>  $model['list_items'] ?? '',
            'col'           => $model['col'] ?? 3,
        ];
        return view('blocks.promotion.index', $data);
    }
}

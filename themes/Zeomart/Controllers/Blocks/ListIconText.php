<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class ListIconText extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ],
                    ]
                ],
                [
                    'id' => 'title',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Title"),
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'name',
                    'settings'    => [
                        [
                            'id'    => 'icon_image',
                            'type'  => 'uploader',
                            'label' => __('Icon Image')
                        ],
                        [
                            'id'    => 'name',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Title')
                        ],
                        [
                            'id'    => 'desc',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Description')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('List Icon Text');
    }

    public function content($model = [])
    {
        $data = [
            'style' => $model['style'] ?? 'style_1',
            'title' => $model['title'] ?? '',
            'list_items'  =>  $model['list_items'] ?? []
        ];

        return view("blocks.list-icon-text.index", $data);
    }
}

<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class Counter extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id' => 'title',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Title")
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'label',
                    'settings'    => [
                        [
                            'id'    => 'number',
                            'type'  => 'input',
                            'inputType' => 'number',
                            'label' => __('Number')
                        ],
                        [
                            'id'    => 'unit',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Unit')
                        ],
                        [
                            'id'    => 'label',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Label')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Counter');
    }

    public function content($model = [])
    {
        $data = [
            'title' => $model['title'] ?? '',
            'list_items'  =>  $model['list_items'] ?? []
        ];

        return view("blocks.counter.index", $data);
    }
}
